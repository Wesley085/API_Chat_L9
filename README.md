# Chat em Tempo Real com Laravel

## Resumo

    Envio de mensagens: Verifica se existe um chat anterior entre os usuários e, se necessário, cria um novo chat no banco de dados. As mensagens são transmitidas em tempo real via Pusher.

    Carregamento de mensagens: Oferece suporte para carregar mensagens anteriores com base no chat_id ou nos IDs dos usuários, além de permitir rolagem para longas conversas.

    Integração com Pusher: Garante a transmissão em tempo real das mensagens entre os usuários.

### Este projeto implementa o **back-end** de um aplicativo de chat em tempo real com Laravel.  
  **O front-end não está incluído.**

___________________________________________________________________________________________________

## 1. Configuração de Rotas

No arquivo `api.php`, adicione as seguintes rotas:

    Route::post("SendMessage", [\App\Http\Controllers\ChatController::class, "SendMessage"]);
    Route::get("load", [\App\Http\Controllers\MessagesController::class, "LoadThePreviousMessages"]);
_______________________________________________________________________________________________


## 2. Controladores

ChatController
Responsável por enviar mensagens.

Implemente a função SendMessage para:

Validar o ID do usuário.
Verificar se existe um chat anterior entre os usuários:
Se não houver, criar um novo chat no banco de dados.
Se houver, adicionar a mensagem ao chat existente.
Transmitir a mensagem via Pusher.
MessagesController
Responsável por carregar mensagens anteriores.

Implemente a função para:

Carregar mensagens com base no chat_id ou IDs do remetente e destinatário.
Suportar rolagem (scroll infinito).

_____________________________________________________________________________________________________

## 3. Evento SendMessageEvent

Este evento transmite as mensagens para o Pusher.
Exemplo de método de transmissão:
public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }

____________________________________________________________________________________________________


## 4. Configuração do Pusher
No arquivo .env, altere:

env
Copiar código
BROADCAST_DRIVER=pusher

Não se esqueça de alterar o arquivo BROADCAST_DRIVER no .env de log para pusher ...
_____________________________________________________________________________________________________

