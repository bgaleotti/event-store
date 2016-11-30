<?php
/**
 * This file is part of the prooph/event-store.
 * (c) 2014-2016 prooph software GmbH <contact@prooph.de>
 * (c) 2015-2016 Sascha-Oliver Prolic <saschaprolic@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Prooph\EventStore\Projection;

use Prooph\EventStore\InMemoryEventStore;

final class InMemoryEventStoreProjection extends AbstractProjection
{
    use InMemoryEventStoreQueryTrait;

    public function __construct(InMemoryEventStore $eventStore, string $name, bool $emitEnabled, int $cacheSize)
    {
        parent::__construct($eventStore, $name, $emitEnabled, $cacheSize);

        $this->buildKnownStreams();
    }

    public function delete(bool $deleteEmittedEvents): void
    {
        if ($deleteEmittedEvents && $this->emitEnabled) {
            $this->resetProjection();
        }
    }

    protected function load(): void
    {
        // InMemoryEventStoreProjection cannot load
    }

    protected function persist(): void
    {
        // InMemoryEventStoreProjection cannot persist
    }
}