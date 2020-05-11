<?php

declare(strict_types=1);

namespace Migrify\ConfigClassPresence\Finder;

use Symfony\Component\Finder\Finder;
use Symplify\SmartFileSystem\Finder\FinderSanitizer;
use Symplify\SmartFileSystem\SmartFileInfo;

final class ConfigFinder
{
    /**
     * @var FinderSanitizer
     */
    private $finderSanitizer;

    public function __construct(FinderSanitizer $finderSanitizer)
    {
        $this->finderSanitizer = $finderSanitizer;
    }

    /**
     * @param string[] $directories
     * @return SmartFileInfo[]
     */
    public function findIn(array $directories): array
    {
        $finder = (new Finder())
            ->in($directories)
            ->files()
            ->notPath('vendor')
            ->name('*.neon')
            ->name('*.yaml');

        return $this->finderSanitizer->sanitize($finder);
    }
}