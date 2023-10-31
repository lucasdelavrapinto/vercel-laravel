<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomRequest;

class ApiController extends Controller
{

    public function test()
    {
        return 'ok';
    }

    public function questions(CustomRequest $request)
    {

        $perguntasPossiveis = [
            'quais as variedades de milho mais produtivas?',
            'o que é vazio sanitário da soja?',
            'quais os impactos da geada no café do Brasil?',
            'quais os principais tipos e sistemas de produção agrícola?'
        ];

        $question = strtolower($request->question);
        $answer = '';
        $selecionada = null;

        foreach ($perguntasPossiveis as $pergunta){
            similar_text($pergunta, $question,$percent);

            if ($percent > 80){
                $selecionada = $pergunta;
            }

        }

        switch ($selecionada){

            case 'quais as variedades de milho mais produtivas?':
                $answer = "O Brasil é o terceiro maior produtor de milho em escala mundial. Sendo assim, todo produtor deste cereal já deve ter se perguntado como aumentar a produtividade da safra, ou quais seleções escolher para uma alta produtividade.";
                break;
            case 'o que é vazio sanitário da soja?':
                $answer = "Se você trabalha com agricultura, provavelmente já ouviu falar do vazio sanitário da soja. A técnica é indispensável na contenção de pragas e doenças, capaz de salvar a colheita de grandes prejuízos";
                break;
            case 'quais os impactos da geada no café do Brasil?':
                $answer = "A geada é um fenômeno climático temido por agricultores em todo o mundo, e no Brasil, as plantações de café estão entre as culturas mais suscetíveis a esse evento, principalmente em regiões de clima subtropical e temperado, como o Sul, o Sudeste e o Centro-Oeste.";
                break;
            case 'quais os principais tipos e sistemas de produção agrícola?':
                $answer = "O termo produção agrícola engloba todos os processos e produtos que trazem benefício advindo da atividade agrícola, com o objetivo de produzir insumos para a alimentação humana e animal, e matéria-prima para produção industrial. ";
                break;

            default:
                $answer = "Não conseguimos entender sua pergunta";
                break;
        }

        return json_encode([
            'resposta' => $answer,
            'match' => $percent
        ]);
    }
}
