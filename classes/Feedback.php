<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Inclua o autoload do Composer

class Feedback {
    public function render() {
        // Exibe o formulário de feedback
        echo '
        <section id="feedback" class="feedback-section">
            <div class="container">
                <h2>Feedback</h2>
                <p>Queremos ouvir de você! Deixe seu feedback e nos ajude a melhorar nossos serviços.</p>
                <div id="feedbackAlert" style="position: fixed; top: 0; left: 0; width: 100%; z-index: 9999;"></div> <!-- Div para mostrar alertas -->

                <form id="formulario" method="POST" action="">
                    <div class="mb-3">
                        <label for="feedbackEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="feedbackEmail" placeholder="seuemail@exemplo.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="feedbackMessage" class="form-label">Mensagem</label>
                        <textarea name="mensagem" class="form-control" id="feedbackMessage" rows="3" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </section>';

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $mensagem = filter_input(INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING);
            $dataHora = date('d/m/Y H:i:s');
            $origemIP = $_SERVER['REMOTE_ADDR'];

            $response = array('status' => 'error', 'message' => 'Por favor, preencha todos os campos corretamente.');

            if ($email && $mensagem) {
                $config = require 'config.php'; // Carrega as configurações

                $mail = new PHPMailer(true);
                try {
                    // Configurações do servidor SMTP
                    $mail->isSMTP();
                    $mail->Host       = $config['smtp_host'];
                    $mail->SMTPAuth   = true;
                    $mail->Username   = $config['smtp_username'];
                    $mail->Password   = $config['smtp_password'];
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = $config['smtp_port'];

                    // E-mail para você com as informações detalhadas
                    $mail->setFrom($config['smtp_username'], 'Feedback Form');
                    $mail->addAddress('wanderson.iesb@gmail.com'); // Seu e-mail

                    $mail->isHTML(true);
                    $mail->Subject = 'Novo Feedback Recebido';

                    // Caminho da imagem
                    $logoPath = realpath(__DIR__ . '/image/logo.jpg');

                    // Verifica se o caminho da imagem está correto e se o arquivo existe
                    if (file_exists($logoPath)) {
                        // Adiciona a imagem como um anexo inline
                        $mail->AddEmbeddedImage($logoPath, 'logo_img');
                        // Corpo do e-mail com a imagem inline
                        $mail->Body = "<img src='cid:logo_img' alt='Logo'><br><br>".
                                      "Você recebeu uma nova mensagem de feedback:<br><br>".
                                      "<strong>Email do remetente:</strong> $email<br>".
                                      "<strong>Data/Hora:</strong> $dataHora<br>".
                                      "<strong>Origem (IP):</strong> $origemIP<br><br>".
                                      "<strong>Mensagem:</strong><br>$mensagem";
                    } else {
                        // Se a imagem não estiver disponível
                        $mail->Body = "Você recebeu uma nova mensagem de feedback:<br><br>".
                                      "<strong>Email do remetente:</strong> $email<br>".
                                      "<strong>Data/Hora:</strong> $dataHora<br>".
                                      "<strong>Origem (IP):</strong> $origemIP<br><br>".
                                      "<strong>Mensagem:</strong><br>$mensagem<br><br>".
                                      "<small>Nota: A imagem não foi encontrada.</small>";
                    }

                    $mail->send();

                    // Enviar e-mail de confirmação para o usuário
                    $mail->clearAddresses();
                    $mail->addAddress($email); // Enviar para o e-mail do usuário

                    $mail->Subject = 'Confirmação de Recebimento de Feedback';
                    $mail->Body    = "Obrigado por enviar seu feedback!<br><br>".
                                     "Recebemos sua mensagem com as seguintes informações:<br>".
                                     "<strong>Data/Hora:</strong> $dataHora<br>".
                                     "<strong>Origem (IP):</strong> $origemIP<br><br>".
                                     "<strong>Sua mensagem:</strong><br>$mensagem";

                    $mail->send();

                    // Resposta de sucesso
                    $response = array('status' => 'success', 'message' => 'Mensagem enviada com sucesso! Em breve entraremos em contato.');

                } catch (Exception $e) {
                    // Resposta de erro
                    $response = array('status' => 'error', 'message' => 'Erro ao enviar a mensagem. Detalhes: ' . htmlspecialchars($mail->ErrorInfo));
                }
            }

            // Exibe o alerta com a resposta
            echo "<script>
                var alertDiv = document.getElementById('feedbackAlert');
                alertDiv.innerHTML = '<div class=\"alert alert-" . ($response['status'] === 'success' ? "success" : "danger") . "\" role=\"alert\">" . $response['message'] . "</div>';
                setTimeout(function() {
                    alertDiv.innerHTML = '';
                }, 2000); // Alerta desaparece após 2 segundos
            </script>";

            // Limpa o formulário
            if ($response['status'] === 'success') {
                echo "<script>
                    document.getElementById('formulario').reset();
                </script>";
            }

            exit;
        }
    }
}
?>
