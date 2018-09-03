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

    public function getFullName() : string
    {
        return $this->name;
    }

    public function getFirstName() : string
    {
        $parts = explode(' ', $this->name);

        return array_shift($parts);
    }

    public function getLastName() : string
    {
        $parts = explode(' ', $this->name);
        array_shift($parts);

        return implode(' ', $parts);
    }

    public function hasLastName() : bool
    {
        return strlen($this->getLastName()) > 0;
    }

    public function getInitials(bool $withDots = false) : string
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

    public function getFamiliar() : string
    {
        if (! $this->hasLastName()) {
            return $this->getFirstName();
        }

        return trim($this->getFirstName() . ' ' . substr($this->getInitials(true), -2));
    }

    public function getAbbreviated() : string
    {
        return trim(substr($this->getInitials(true), 0, 2) . ' ' . $this->getLastName());
    }

    public function getSorted() : string
    {
        if (!$this->hasLastName()) {
            return $this->getFirstName();
        }

        return $this->getLastName() . ', ' . $this->getFirstName();
    }

    public function getMentionable() : string
    {
        $parts = explode(' ', $this->name);

        return strtolower($this->getFirstName() . substr($this->getLastName(), 0, 1));
    }

    public function getPossessive() : string
    {
        $suffix = substr($this->name, -1) === 's' ? "'" : "'s";

        return $this->name . $suffix;
    }
}
