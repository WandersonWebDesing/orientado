<?php
require_once 'classes/Navbar.php';
require_once 'classes/Carousel.php';
require_once 'classes/Section.php';
require_once 'classes/Supporters.php';
require_once 'classes/Feedback.php';
require_once 'classes/Footer.php';

$navbar = new Navbar();
$carousel = new Carousel();
$homeSection = new Section('home', 'Bem-vindo à WandersonWeb', 'Onde suas ideias ganham vida no mundo digital.');
$aboutSection = new Section('about', 'Sobre Nós', 'WandersonWeb é uma empresa especializada em impulsionar o crescimento de negócios por meio de soluções inovadoras em marketing digital e tecnologia avançada. Com uma formação completa em tecnologia e vasta experiência em infraestrutura de sistemas, oferecemos um leque de serviços que vão além do marketing. Nossa expertise abrange desde a implementação de estratégias digitais eficazes utilizando as ferramentas mais avançadas do Google até a consultoria e manutenção de computadores e sistemas de telecomunicações. Se você busca não apenas alcançar, mas superar seus objetivos de marketing e tecnologia, a WandersonWeb é a parceira ideal para transformar seu negócio.');
$servicesSection = new Section('services', 'Serviços', 'Na WandersonWeb, não apenas realizamos suas visões – nós as transformamos em realidades digitais impactantes. Seja bem-vindo a um espaço onde a inovação encontra a estratégia, e cada projeto é moldado com excelência para impulsionar o sucesso do seu negócio. Vamos juntos dar vida às suas ideias, criando soluções que vão além do esperado e posicionam sua marca no topo.');
$storeSection = new Section('store', 'Loja', 'Transforme sua presença online com o Web Design Personalizado da WandersonWeb. Em um mundo digital cada vez mais competitivo, ter um site que não só atraia visitantes, mas também converta e engaje, é crucial para o sucesso do seu negócio. Nossa equipe de especialistas em web design está aqui para criar um site que reflete perfeitamente a identidade da sua marca e proporciona uma experiência excepcional para os usuários.');
$supporters = new Supporters();
$feedback = new Feedback();
$footer = new Footer();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WandersonWeb</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <?php
    $navbar->render();
    $carousel->render();
    $homeSection->render();
    $aboutSection->render();
    $servicesSection->render();
    $storeSection->render();
    $supporters->render();
    $feedback->render();
    $footer->render();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
