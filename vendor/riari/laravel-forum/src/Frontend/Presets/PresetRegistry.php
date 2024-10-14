<?php

namespace TeamTeaTime\Forum\Frontend\Presets;

class PresetRegistry
{
    private array $presets = [];

    public function register(AbstractPreset $preset)
    {
        if (isset($this->presets[$preset->getName()])) {
            throw new \Exception("Preset '{$preset->getName()}' is already registered.");
        }

        $this->presets[$preset->getName()] = $preset;
    }

    public function get(string $name): AbstractPreset
    {
        if (!isset($this->presets[$name])) {
            throw new \Exception("Preset '{$name}' not found. Check the name and ensure the preset is registered.");
        }

        return $this->presets[$name];
    }

    public function getAll(): array
    {
        return $this->presets;
    }
}
