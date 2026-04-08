<?php

declare(strict_types=1);

namespace App\View\Presenters;

final class CustomSectionPresenter
{
    /**
     * @param list<array<string, mixed>> $blocks
     */
    private function __construct(
        private readonly array $blocks,
    ) {
    }

    public static function fromBody(string $body): self
    {
        $normalizedBody = trim(str_replace(["\r\n", "\r"], "\n", $body));

        if ($normalizedBody === '') {
            return new self([]);
        }

        $chunks = preg_split('/\n\s*\n+/u', $normalizedBody) ?: [];
        $blocks = [];

        foreach ($chunks as $chunk) {
            $content = trim($chunk);

            if ($content === '') {
                continue;
            }

            $highlightBlock = self::highlightBlock($content);

            if ($highlightBlock !== null) {
                $blocks[] = $highlightBlock;
                continue;
            }

            $bulletBlock = self::bulletBlock($content);

            if ($bulletBlock !== null) {
                $blocks[] = $bulletBlock;
                continue;
            }

            $blocks[] = self::paragraphBlock($content);
        }

        return new self($blocks);
    }

    /**
     * @return array{type: string, text: string}|null
     */
    private static function highlightBlock(string $content): ?array
    {
        if (! str_starts_with($content, '>>')) {
            return null;
        }

        $text = trim((string) preg_replace('/^>>\s*/u', '', $content));

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'highlight',
            'text' => $text,
        ];
    }

    /**
     * @return array{type: string, items: list<string>}|null
     */
    private static function bulletBlock(string $content): ?array
    {
        $lines = self::normalizedLines($content);

        if ($lines === []) {
            return null;
        }

        $bulletLines = array_filter($lines, static fn (string $line): bool => str_starts_with($line, '-'));

        if (count($bulletLines) !== count($lines)) {
            return null;
        }

        $items = array_values(array_filter(array_map(
            static fn (string $line): string => trim((string) preg_replace('/^-\s*/u', '', $line)),
            $lines,
        ), static fn (string $line): bool => $line !== ''));

        if ($items === []) {
            return null;
        }

        return [
            'type' => 'bullets',
            'items' => $items,
        ];
    }

    /**
     * @return array{type: string, text: string}
     */
    private static function paragraphBlock(string $content): array
    {
        return [
            'type' => 'paragraph',
            'text' => implode("\n", self::normalizedLines($content)),
        ];
    }

    /**
     * @return list<string>
     */
    private static function normalizedLines(string $content): array
    {
        return array_values(array_filter(
            array_map(static fn (string $line): string => trim($line), explode("\n", $content)),
            static fn (string $line): bool => $line !== '',
        ));
    }

    /**
     * @return list<array<string, mixed>>
     */
    public function blocks(): array
    {
        return $this->blocks;
    }
}
