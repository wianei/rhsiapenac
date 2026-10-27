<?php

namespace App\Classes;


class Tstring
{
    public static function nomeUf($uf)
    {
        //$UF = $uf;
        $estados = array(
            "Acre" => "AC",
            "Alagoas" => "AL",
            "Amapá" => "AP",
            "Amazonas" => "AM",
            "Bahia" => "BA",
            "Ceará" => "CE",
            "Distrito Federal" => "DF",
            "Espírito Santo" => "ES",
            "Goiás" => "GO",
            "Maranhão" => "MA",
            "Mato Grosso" => "MT",
            "Mato Grosso do Sul" => "MS",
            "Minas Gerais" => "MG",
            "Pará" => "PA",
            "Paraíba" => "PB",
            "Paraná" => "PR",
            "Pernambuco" => "PE",
            "Piauí" => "PI",
            "Rio de Janeiro" => "RJ",
            "Rio Grande do Norte" => "RN",
            "Rio Grande do Sul" => "RS",
            "Rondônia" => "RO",
            "Roraima" => "RR",
            "São Paulo" => "SP",
            "Sergipe" => "SE",
            "Tocantins" => "TO"

        );

        $result = array_search($uf, $estados);

        return $result;

    }

    public static function licencas()
    {

        $tipo = array(
            'Por motivo de acidente em serviço ou doença profissional',
            'Por motivo de gestação, adoção ou guarda judicial',
            'Por motivo de doença em pessoa da família',
            'Por motivo de afastamento de cônjuge ou companheiro',
            'Para fins de serviço militar',
            'Para fins de atividade política',
            'Para fins de desempenho de mandato classita',
            'Para tratamento de Saúde',
            'Prêmio por assiduidade',
            'Para tratar de interesses particulares'
        );

        return $tipo;

    }

    public static function afastamentos()
    {

        // afastamento
        $tipo = array(
            'Para Servir em outro Poder, Órgão ou Entidade',
            'Para Exercício de Mandato Eletivo',
            'Afastamento em Missão Oficial',
            'Para Estudo, Estágio ou Treinamento',
        );

        return $tipo;

    }

    public static function penalidades()
    {

        // penalidades
        $tipo = array(
            'Advertência',
            'Suspensão',
            'Demissão',
            'Cassação de aposentadoria ou disponibilidade',
            'Destituição de cargo em comissão',
            'Destituição de função de direção, chefia ou assessoramento',
        );

        return $tipo;

    }

    public static function secretariasEstadoBA()
    {
        $tipo = array(
            'IAPEN - AC',
            'Outros'
        );

        return $tipo;
    }

    public static function cursosSuperiores()
    {
        $tipo = array(
            'Administração',
            'Agrimensura',
            'Agroecologia',
            'Agroindústria',
            'Agronomia (ou Engenharia agronômica)',
            'Análise e Desenvolvimento de Sistemas',
            'Antropologia',
            'Aquacultura',
            'Arqueologia',
            'Arquitetura',
            'Arquivística',
            'Artes Cênicas (licenciatura)',
            'Artes Visuais (licenciatura)',
            'Astronomia',
            'Automação Industrial',
            'Biblioteconomia',
            'Biocombustíveis',
            'Bioengenharia',
            'Biofísica',
            'Biologia (licenciatura)',
            'Biologia marinha',
            'Biomedicina',
            'Biotecnologia',
            'Botânica',
            'Cafeicultura',
            'Ciência & Tecnologia',
            'Ciência da Computação (licenciatura)',
            'Ciência dos Alimentos',
            'Ciência dos materiais',
            'Ciência Política (ou Ciências do Estado)',
            'Ciências Aeronáuticas',
            'Ciências Agrárias (licenciatura)',
            'Ciências Ambientais',
            'Ciências Atuariais',
            'Ciências Biológicas',
            'Ciências Biomoleculares',
            'Ciências Contábeis',
            'Ciências Contábeis',
            'Ciências da Saúde',
            'Ciências do Meio Aquático',
            'Ciências Humanas (licenciatura)',
            'Ciências Matemáticas da Terra',
            'Ciências Naturais (licenciatura)',
            'Ciências Náuticas',
            'Ciências Sociais Licenciatura',
            'Cinema',
            'Comércio Exterior',
            'Comunicação social',
            'Construção de Edifícios',
            'Construção de Estradas',
            'Construção Naval',
            'Cooperativismo',
            'Cosmetologia',
            'Dança (licenciatura)',
            'Defesa e Gestão Estratégica Internacional',
            'Desenho Industrial',
            'Design de Interiores',
            'Design de Jogos Digitais',
            'Design de Moda',
            'Design de produto',
            'Design gráfico',
            'Direito',
            'Drenagem e Irrigação',
            'Ecologia',
            'Economia',
            'Economia Doméstica',
            'Editoração',
            'Educação Artística (licenciatura)',
            'Educação do Campo (licenciatura)',
            'Educação física (licenciatura)',
            'Energias Renováveis',
            'Enfermagem (licenciatura)',
            'Engenharia aeroespacial',
            'Engenharia aeronáutica',
            'Engenharia Agrícola',
            'Engenharia Ambiental',
            'Engenharia biomédica',
            'Engenharia Cartográfica (ou Engenharia geográfica)',
            'Engenharia Civil',
            'Engenharia de Alimentos',
            'Engenharia de Computação',
            'Engenharia de controle e automação',
            'Engenharia de manufatura',
            'Engenharia de Materiais',
            'Engenharia de Minas',
            'Engenharia de Pesca',
            'Engenharia de Petróleo',
            'Engenharia de Produção',
            'Engenharia de Sistemas Eletrônicos',
            'Engenharia de Software',
            'Engenharia de Tecidos',
            'Engenharia de Telecomunicações',
            'Engenharia Elétrica (ou Engenharia de Energia)',
            'Engenharia Física',
            'Engenharia Florestal',
            'Engenharia geológica',
            'Engenharia Industrial Madeireira',
            'Engenharia Mecânica',
            'Engenharia Mecatrônica',
            'Engenharia Metalúrgica',
            'Engenharia Militar',
            'Engenharia Naval e Oceânica',
            'Engenharia Nuclear',
            'Engenharia Química',
            'Engenharia Sanitária',
            'Engenharia Têxtil',
            'Enologia',
            'Escultura',
            'Espanhol (licenciatura)',
            'Esporte e Lazer',
            'Estatística',
            'Eventos',
            'Farmácia (ou Bioquímica)',
            'Filosofia (licenciatura)',
            'Física (licenciatura)',
            'Física computacional',
            'Física médica',
            'Fisioterapia',
            'Fonoaudiologia',
            'Fotografia',
            'Fruticultura',
            'Gastronomia',
            'Geofísica',
            'Geografia (licenciatura)',
            'Geologia (licenciatura)',
            'Geoprocessamento e Sensoriamento Remoto',
            'Gerontologia',
            'Gestão Ambiental',
            'Gestão Comercial',
            'Gestão Pública',
            'Gestão da Qualidade',
            'Gestão da Tecnologia da Informação',
            'Gestão de Petróleo e Gás',
            'Gestão de Recursos Hídricos',
            'Gestão de Recursos Humanos',
            'Gestão de Segurança Privada',
            'Gestão do Agronegócio',
            'Gestão em serviços jurídicos e notariais',
            'Gestão em políticas públicas',
            'Gestão Financeira',
            'Gestão Hospitalar',
            'Gestão Portuária',
            'Gestão Pública',
            'Gestão de Segurança Pública',
            'Gestão de Segurança Pessoal e Patrimonial (tecnólogo)',
            'Gravurismo',
            'História (licenciatura)',
            'História da Arte',
            'Horticultura',
            'Hotelaria',
            'Informática (licenciatura)',
            'Informática biomédica',
            'Jornalismo',
            'Letras (licenciatura)',
            'Linguística',
            'Logística',
            'Manutenção Industrial',
            'Matemática (licenciatura)',
            'Matemática Aplicada',
            'Matemática computacional',
            'Mecatrônica e Mecânica de Precisão',
            'Medicina',
            'Medicina veterinária',
            'Meliponicultura',
            'Mercadologia',
            'Meteorologia',
            'Microbiologia e Imunologia',
            'Mineração',
            'Museologia',
            'Música (licenciatura)',
            'Nanotecnologia',
            'Naturologia',
            'Negócios Imobiliários',
            'Neurociência',
            'Nutrição',
            'Oceanografia ',
            'Odontologia',
            'Oftálmica',
            'Ordenamento do Território',
            'Paisagismo',
            'Pedagogia (licenciatura)',
            'Pintura',
            'Processamento de Dados',
            'Processos Escolares',
            'Processos Gerenciais',
            'Processos Metalúrgicos',
            'Produção Audiovisual ',
            'Produção Cultural',
            'Produção de Aguardente',
            'Produção de Laticínios',
            'Produção de Materiais Plásticos',
            'Produção Fonográfica',
            'Produção Sucroalcooeira',
            'Produção Têxtil',
            'Projetos de Estruturas Aeronáuticas',
            'Psicologia (bacharelado)',
            'Psicologia (licenciatura)',
            'Publicidade & Propaganda',
            'Química (licenciatura)',
            'Química ambiental',
            'Química industrial',
            'Quiropraxia',
            'Radiologia',
            'Recursos Humanos',
            'Redes de Computadores',
            'Redes de Telecomunicações',
            'Relações Internacionais',
            'Relações Públicas',
            'Saneamento Ambiental',
            'Saúde Coletiva',
            'Secretariado',
            'Segurança da Informação',
            'Segurança no Trabalho',
            'Segurança Pública',
            'Serviço Social (licenciatura)',
            'Serviço Social (bacharelado)',
            'Silvicultura',
            'Sistemas Biomédicos',
            'Sistemas Biomédicos',
            'Sistemas de Informação',
            'Sistemas de Navegação Fluvial',
            'Sistemas Elétricos',
            'Sistemas Embarcados',
            'Sistemas para Internet',
            'Sociologia (licenciatura)',
            'Teatro (licenciatura)',
            'Tecnologia da Informação',
            'Tecnologia em Recursos Humanos',
            'Tecnologia em Marketing',
            'Telemática',
            'Teologia',
            'Terapia ocupacional',
            'Transporte Aéreo',
            'Transporte Terrestre',
            'Turismologia',
            'Urbanismo',
            'Zootecnia');

        return $tipo;

    }
}