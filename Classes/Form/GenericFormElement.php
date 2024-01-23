<?php
declare(strict_types=1);

namespace Form;

abstract class GenericFormElement implements InputRenderInterface
{
    protected string $type;
    protected bool $required = false;
    protected mixed $value = '';
    protected string $name;
    protected string $id;

    public function __construct(
        string $name,
        $required, 
        string $defaultValue,
        string $id,
    )
    {
        $this->name = $name;
        $this->required = $required;
        $this->value = $defaultValue;
        $this->id = $id;
    }

    public function __toString(): string
    {
        return $this->render();
    }

    function getId(): string 
    {
        return $this->id;
    }

    function getName(): string 
    {
        return $this->name;
    }

    function getValue(): array|string 
    {
        return $this->value;
    }

    function isRequired(): bool
    {
        return $this->required;
    }
}