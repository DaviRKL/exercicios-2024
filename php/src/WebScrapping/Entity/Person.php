<?php

namespace Chuva\Php\WebScrapping\Entity;

/**
 * Paper Author personal information.
 */
class Person
{
    /**
     * Person name.
     *
     * @var string
     */
    public string $name;

    /**
     * Person institution.
     *
     * @var string
     */
    public string $institution;

    /**
     * Constructor.
     *
     * @param string $name        The name of the person.
     * @param string $institution The institution of the person.
     */
    public function __construct(string $name, string $institution)
    {
        $this->name = $name;
        $this->institution = $institution;
    }

    /**
     * Get the name of the person.
     *
     * @return string The name of the person.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the institution of the person.
     *
     * @return string The institution of the person.
     */
    public function getInstitution(): string
    {
        return $this->institution;
    }
}
