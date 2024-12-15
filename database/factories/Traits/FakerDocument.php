<?php

namespace Database\Factories\Traits;

use App\Enum\Suppliers\DocumentTypeEnum;

trait FakerDocument
{
    /**
     * Gera um documento aleatório da lista de documentos predefinidos.
     *
     * @return array
     */
    public function generateRandomDocument(): array
    {
        $documents = $this->documents();
        return $documents[array_rand($documents)];
    }

    /**
     * Retorna uma lista de documentos predefinidos.
     * @return array
     */
    public function documents(): array
    {
    return [
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '62941870000112'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '47905261000114'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '18493027000129'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '10596487000170'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '31467250961'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '69045712000123'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '09136854298'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '05963148000145'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '29645387000115'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '27438961000139'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '62538491000186'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '24910583750'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '03468217000119'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '19260583000118'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '70639524800'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '05391672821'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '76304281000138'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '21053784000196'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '41570398666'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '28134709000107'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '08275619000110'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '36281547000150'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '30264789000159'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '72105369499'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '45320179000100'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '29486307000126'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '83649572109'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '68392457137'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '21085793460'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '71290845611'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '38751026000144'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '74859123000119'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '72350864162'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '70364185000107'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '62074953810'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '92038451605'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '70549816267'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '37642958056'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '83654029000114'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '45731980241'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '72691543000103'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '84102396000178'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '08354196000124'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '30587691484'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '42971830640'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '58926470130'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '57148630000125'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '49302618000103'],
        ['type' => DocumentTypeEnum::CNPJ, 'number' => '18256047000186'],
        ['type' => DocumentTypeEnum::CPF, 'number' => '47103825653'],
        ];
    }
}