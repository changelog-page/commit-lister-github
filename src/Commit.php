<?php

declare(strict_types=1);

namespace Changelog\CommitLister\GitHub;

use Spatie\DataTransferObject\Attributes\MapFrom;
use Spatie\DataTransferObject\DataTransferObject;

final class Commit extends DataTransferObject
{
    public array $data;

    #[MapFrom('sha')]
    public string $hash;

    #[MapFrom('commit.message')]
    public string $message;

    #[MapFrom('html_url')]
    public string $url;

    #[MapFrom('commit.author.date')]
    public string $date;

    #[MapFrom('data')]
    public Author $author;
}
