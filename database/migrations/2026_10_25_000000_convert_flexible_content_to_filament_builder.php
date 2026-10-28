<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    private const FLEXIBLE_COLUMNS = [
        'sections' => 'content',
        'pages' => 'links',
    ];

    public function up(): void
    {
        $this->convertColumns(fn (array $item) => $this->toBuilderBlock($item));
    }

    public function down(): void
    {
        $this->convertColumns(fn (array $item) => $this->toWhitecubeLayout($item));
    }

    private function convertColumns(Closure $convertItem): void
    {
        foreach (self::FLEXIBLE_COLUMNS as $table => $column) {
            DB::table($table)
                ->whereNotNull($column)
                ->orderBy('id')
                ->chunkById(100, function ($rows) use ($table, $column, $convertItem) {
                    foreach ($rows as $row) {
                        $items = json_decode($row->{$column}, true);

                        if (! is_array($items)) {
                            continue;
                        }

                        $converted = json_encode(array_map(
                            fn (mixed $item) => is_array($item) ? $convertItem($item) : $item,
                            $items,
                        ));

                        if ($converted !== $row->{$column}) {
                            DB::table($table)->where('id', $row->id)->update([$column => $converted]);
                        }
                    }
                });
        }
    }

    private function toBuilderBlock(array $item): array
    {
        if (! array_key_exists('layout', $item)) {
            return $item;
        }

        return [
            'type' => $item['layout'],
            'data' => (object) ($item['attributes'] ?? []),
        ];
    }

    private function toWhitecubeLayout(array $item): array
    {
        if (! array_key_exists('type', $item)) {
            return $item;
        }

        return [
            'layout' => $item['type'],
            'key' => Str::random(16),
            'attributes' => (object) ($item['data'] ?? []),
        ];
    }
};
