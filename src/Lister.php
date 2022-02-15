<?php

declare(strict_types=1);

namespace Changelog\CommitLister\GitHub;

use Changelog\CommitLister\Lister as Contract;
use Changelog\Hydrator\HydratesResources;
use Github\AuthMethod;
use Github\Client;
use Github\ResultPager;
use Illuminate\Support\Collection;

final class Lister implements Contract
{
    use HydratesResources;

    private Client $client;

    public function __construct(string $accessToken)
    {
        $this->client = new Client();
        $this->client->authenticate($accessToken, null, AuthMethod::ACCESS_TOKEN);
    }

    public function byUser(string $uuid, string $branch, ?array $options): Collection
    {
        return $this->by($uuid, $branch, $options);
    }

    public function byTeam(string $uuid, string $branch, ?array $options): Collection
    {
        return $this->by($uuid, $branch, $options);
    }

    private function by(string $uuid, string $branch, ?array $options): Collection
    {
        [$username, $repository] = explode('/', $uuid);

        return $this->hydrate(
            (new ResultPager($this->client))->fetchAll(
                $this->client->api('repo')->commits(),
                'all',
                [$username, $repository, ['sha' => $branch]],
            ),
            Commit::class,
        );
    }
}
