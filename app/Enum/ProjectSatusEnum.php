<?php

namespace App\Enum;

enum ProjectSatusEnum: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;
    case INPROGRESS = 2;
    case COMPLETED = 3;

    public function parse()
    {
        return match ($this) {
            self::INACTIVE => "Inativo",
            self::ACTIVE => "Ativo",
            self::INPROGRESS => "Em Progresso",
            self::COMPLETED => "Concluído",
            default => "Status não encontrado",
        };
    }

}
