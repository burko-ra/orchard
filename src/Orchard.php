<?php

namespace Orchard;

class Orchard
{
    public function addTree($treeType)
    {
        return new FruitTree($treeType);
    }
}
