<?php

declare(strict_types=1);

namespace Laravolt\Media;

use Illuminate\Support\Arr;
use Laravolt\Platform\Models\Guest;

class MediaInputBag
{
    protected $key;

    protected $files = [];

    protected $holder;

    /**
     * MediaInputBag constructor.
     */
    public function __construct($key)
    {
        $this->key = $key;
        $this->files = request($this->key);
        $this->holder = auth()->user() ?? Guest::first();
    }

    public function toArray(): array
    {
        return collect(json_decode(request("_{$this->key}", '{}'), true))->flatten()->toArray();
    }

    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    public function first(): ?string
    {
        return Arr::first($this->toArray());
    }

    public function store(string $collection = 'default'): array
    {
        $key = $this->key;
        $files = request()->file($key) ?? [];
        $media = [];
        foreach ($files as $file) {
            $media[] = $this->holder->addMedia($file)->toMediaCollection($collection);
        }

        return $media;
    }
}
