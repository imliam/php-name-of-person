<?php

namespace ImLiam\NameOfPerson;

class Name
{
    protected $name = '';

    public function __construct(string $name)
    {
        $this->name = trim($name);

        if (strlen($this->name) === 0) {
            throw new \InvalidArgumentException('No name provided.');
        }
    }

    public function getFullName(): string
    {
        return $this->name;
    }

    public function getFirstName(): string
    {
        $parts = explode(' ', $this->name);

        return array_shift($parts);
    }

    public function getLastName(): string
    {
        $parts = explode(' ', $this->name);
        array_shift($parts);

        return implode(' ', $parts);
    }

    public function hasLastName(): bool
    {
        return strlen($this->getLastName()) > 0;
    }

    public function getInitials(bool $withDots = false): string
    {
        $parts = explode(' ', $this->name);
        $initials = '';

        foreach ($parts as $part) {
            $initials .= $part[0];

            if ($withDots) {
                $initials .= '.';
            }
        }

        return $initials;
    }

    public function getFamiliar(): string
    {
        if (! $this->hasLastName()) {
            return $this->getFirstName();
        }

        return trim($this->getFirstName() . ' ' . substr($this->getInitials(true), -2));
    }

    public function getAbbreviated(): string
    {
        return trim(substr($this->getInitials(true), 0, 2) . ' ' . $this->getLastName());
    }

    public function getSorted(): string
    {
        if (! $this->hasLastName()) {
            return $this->getFirstName();
        }

        return $this->getLastName() . ', ' . $this->getFirstName();
    }

    public function getMentionable(): string
    {
        $parts = explode(' ', $this->name);

        return strtolower($this->getFirstName() . substr($this->getLastName(), 0, 1));
    }

    public function getPossessive(): string
    {
        $suffix = substr($this->name, -1) === 's' ? "'" : "'s";

        return $this->name . $suffix;
    }

    /**
     * Get a properly formatted version of the original name, with correct
     * capitalisation even if the name has particles that need different
     * capitalisation based on their position in the name.
     *
     * @see https://www.media-division.com/correct-name-capitalization-in-php/#services
     */
    public function getProperName(): string
    {
        $wordDelimeters = [' ', '-', 'O’', 'L’', 'D’', 'St.', 'Mc', "O'", "L'", "D'"];
        $lowercaseExceptions = ['the', 'van', 'den', 'von', 'und', 'der', 'de', 'da', 'of', 'and', 'l’', 'd’', "l'", "d'"];
        $uppercaseException = ['III', 'IV', 'VI', 'VII', 'VIII', 'IX'];

        $name = strtolower($this->name);

        foreach ($wordDelimeters as $delimiter) {
            $words = explode($delimiter, $name);
            $newwords = [];

            foreach ($words as $word) {
                if (in_array(strtoupper($word), $uppercaseException)) {
                    $word = strtoupper($word);
                } elseif (! in_array($word, $lowercaseExceptions)) {
                    $word = ucfirst($word);
                }

                $newwords[] = $word;
            }

            if (in_array(strtolower($delimiter), $lowercaseExceptions)) {
                $delimiter = strtolower($delimiter);
            }

            $name = join($delimiter, $newwords);
        }

        return $name;
    }
}
