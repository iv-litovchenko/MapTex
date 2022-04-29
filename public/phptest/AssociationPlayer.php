<?php

namespace Test;

class AssociationPlayer
{
    private $team; // AssociationTeam

    public function __construct()
    {
    }

    public function getTeam() // : AssociationTeam
    {
        return $this->team;
    }

    public function setTeam(AssociationTeam $team) // : void
    {
        $this->team = $team;
    }
}