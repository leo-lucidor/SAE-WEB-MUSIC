<?php
declare(strict_types=1);

namespace Form\Type;

use Form\GenericFormElement;

abstract class Input extends GenericFormElement
{
    // Fonction permettant d'interpréteer les objets inputs créée dans les classes en html
    public function render(): string
    {
        return sprintf(
            '<input type="%s" %s value="%s" name="%s" id="%s"/>', 
            $this->type,
            $this->isRequired() ? 'required="required"' : '',
            $this->getValue(),
            $this->type == 'checkbox' ? $this->name . '[]' : $this->name,
            $this->getId()
        );
    }
}