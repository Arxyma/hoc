<?php

namespace TeamTeaTime\Forum\Http\Controllers\Blade;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use TeamTeaTime\Forum\Models\Category;
use Illuminate\Support\Facades\Storage;
use TeamTeaTime\Forum\Support\Frontend\Forum;
use TeamTeaTime\Forum\Events\UserViewingIndex;
use TeamTeaTime\Forum\Events\UserViewingCategory;
use TeamTeaTime\Forum\Http\Requests\EditCategory;
use TeamTeaTime\Forum\Support\Access\ThreadAccess;
use Illuminate\Support\Facades\View as ViewFactory;
use TeamTeaTime\Forum\Http\Requests\CreateCategory;
use TeamTeaTime\Forum\Http\Requests\DeleteCategory;
use TeamTeaTime\Forum\Support\Access\CategoryAccess;

class CategoryController extends BaseController
{
    public function index(Request $request): View
    {
        $categories = CategoryAccess::getFilteredTreeFor($request->user())->toTree();

        if ($request->user() !== null) {
            UserViewingIndex::dispatch($request->user());
        }

        return ViewFactory::make('forum::category.index', compact('categories'));
    }

    public function show(Request $request): View
    {
        $category = $request->route('category');

        if (!$category->isAccessibleTo($request->user())) {
            abort(404);
        }

        if ($request->user() !== null) {
            UserViewingCategory::dispatch($request->user(), $category);
        }

        $privateAncestor = CategoryAccess::getPrivateAncestor($request->user(), $category);

        $threadDestinationCategories = $request->user() && $request->user()->can('moveCategories')
            ? Category::query()->threadDestinations()->get()
            : [];

        $threads = $request->user() && $request->user()->can('viewTrashedThreads')
            ? $category->threads()->withTrashed()
            : $category->threads();

        $threads = $threads->withPostAndAuthorRelationships()->ordered()->paginate();

        $selectableThreadIds = ThreadAccess::getSelectableThreadIdsFor($request->user(), $threads, $category);

        return ViewFactory::make('forum::category.show', compact('privateAncestor', 'threadDestinationCategories', 'category', 'threads', 'selectableThreadIds'));
    }

    public function store(CreateCategory $request): RedirectResponse
    {
        $categoryData = $request->validated();
        // $category = $request->fulfill();

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $categoryData['image'] = $request->file('image')->store('category_images', 'public');
        }

        $category = Category::create($categoryData);

        Forum::alert('success', 'categories.created');

        return new RedirectResponse(Forum::route('category.show', $category));
    }

    public function update(EditCategory $request): RedirectResponse
    {
        $category = $request->fulfill();

        if ($category === null) {
            return $this->invalidSelectionResponse();
        }
    
        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('category_images', 'public');
        }
    
        $category->save();
    
        Forum::alert('success', 'categories.updated', 1);
    
        return new RedirectResponse(Forum::route('category.show', $category));
    }

    public function delete(DeleteCategory $request): RedirectResponse
    {
        $request->fulfill();

        Forum::alert('success', 'categories.deleted', 1);

        return new RedirectResponse(Forum::route('index'));
    }

    public function manage(Request $request): View
    {
        $categories = Category::defaultOrder()->get();
        $categories->makeHidden(['_lft', '_rgt', 'thread_count', 'post_count']);

        return ViewFactory::make('forum::category.manage', ['categories' => $categories->toTree()]);
    }
}
