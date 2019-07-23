<?php

namespace ImLiam\NameOfPerson\Tests\Unit;

use ImLiam\NameOfPerson\Name;
use ImLiam\NameOfPerson\Tests\TestCase;

class NameTest extends TestCase
{
    /** @test */
    public function david_heinemeier_hansson_is_a_valid_name()
    {
        $name = new Name('David Heinemeier Hansson');

        $this->assertEquals('David Heinemeier Hansson', $name->getFullName());
        $this->assertEquals('David', $name->getFirstName());
        $this->assertEquals('Heinemeier Hansson', $name->getLastName());
        $this->assertEquals('DHH', $name->getInitials());
        $this->assertEquals('D.H.H.', $name->getInitials(true));
        $this->assertEquals('David H.', $name->getFamiliar());
        $this->assertEquals('D. Heinemeier Hansson', $name->getAbbreviated());
        $this->assertEquals('Heinemeier Hansson, David', $name->getSorted());
        $this->assertEquals('davidh', $name->getMentionable());
        $this->assertEquals('David Heinemeier Hansson\'s', $name->getPossessive());
    }

    /** @test */
    public function liam_hammett_is_a_valid_name()
    {
        $name = new Name('Liam Hammett');

        $this->assertEquals('Liam Hammett', $name->getFullName());
        $this->assertEquals('Liam', $name->getFirstName());
        $this->assertEquals('Hammett', $name->getLastName());
        $this->assertEquals('LH', $name->getInitials());
        $this->assertEquals('L.H.', $name->getInitials(true));
        $this->assertEquals('Liam H.', $name->getFamiliar());
        $this->assertEquals('L. Hammett', $name->getAbbreviated());
        $this->assertEquals('Hammett, Liam', $name->getSorted());
        $this->assertEquals('liamh', $name->getMentionable());
        $this->assertEquals('Liam Hammett\'s', $name->getPossessive());
    }

    /** @test */
    public function bob_is_a_valid_name()
    {
        $name = new Name('Bob');

        $this->assertEquals('Bob', $name->getFullName());
        $this->assertEquals('Bob', $name->getFirstName());
        $this->assertEquals('', $name->getLastName());
        $this->assertEquals('B', $name->getInitials());
        $this->assertEquals('B.', $name->getInitials(true));
        $this->assertEquals('Bob', $name->getFamiliar());
        $this->assertEquals('B.', $name->getAbbreviated());
        $this->assertEquals('Bob', $name->getSorted());
        $this->assertEquals('bob', $name->getMentionable());
        $this->assertEquals('Bob\'s', $name->getPossessive());
    }

    /** @test */
    public function a_name_must_be_supplied()
    {
        $this->expectException(\InvalidArgumentException::class);
        $name = new Name('');
    }

    /** @test */
    public function a_possessive_for_a_name_ending_with_s_will_be_formatted()
    {
        $name = new Name('Charles');

        $this->assertEquals('Charles\'', $name->getPossessive());
    }

    /** @test */
    public function a_name_can_be_properly_capitalised()
    {
        $this->assertEquals('Michael O’Carrol', (new Name('michael o’carrol'))->getProperName());
        $this->assertEquals('Lucas l’Amour', (new Name('lucas l’amour'))->getProperName());
        $this->assertEquals('George d’Onofrio', (new Name('george d’onofrio'))->getProperName());
        $this->assertEquals('William Stanley III', (new Name('william stanley iii'))->getProperName());
        $this->assertEquals('United States of America', (new Name('UNITED STATES OF AMERICA'))->getProperName());
        $this->assertEquals('T. von Lieres und Wilkau', (new Name('t. von lieres und wilkau'))->getProperName());
        $this->assertEquals('Paul van der Knaap', (new Name('paul van der knaap'))->getProperName());
        $this->assertEquals('Jean-Luc Picard', (new Name('jean-luc picard'))->getProperName());
        $this->assertEquals('John McLaren', (new Name('JOHN MCLAREN'))->getProperName());
        $this->assertEquals('Henric VIII', (new Name('hENRIC vIII'))->getProperName());
        $this->assertEquals('Vasco da Gama', (new Name('VAsco da GAma'))->getProperName());
    }
}
