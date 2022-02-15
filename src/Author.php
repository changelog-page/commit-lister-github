<?php

declare(strict_types=1);

namespace Changelog\CommitLister\GitHub;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

final class Author extends DataTransferObject
{
    #[MapFrom('commit.author.name')]
    public string $name;

    #[MapFrom('commit.author.email')]
    public string $email;

    #[MapFrom('author.avatar_url')]
    public ?string $avatar;

    #[MapFrom('author.html_url')]
    public ?string $profile;
}
