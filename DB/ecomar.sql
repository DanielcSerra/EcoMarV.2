-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Tempo de geração: 26-Jan-2026 às 03:50
-- Versão do servidor: 8.0.40
-- versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecomar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `goal` decimal(10,2) NOT NULL,
  `goal_current` decimal(10,2) NOT NULL DEFAULT '0.00',
  `is_large` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `campaigns`
--

INSERT INTO `campaigns` (`id`, `user_id`, `date_start`, `date_end`, `title`, `country`, `description`, `image`, `goal`, `goal_current`, `is_large`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-12-26', '2026-01-25', 'Campanha Limpeza Atlântico', 'portugal', 'Campanha de limpeza costeira em várias praias do Atlântico, envolvendo voluntários locais e internacionais.', 'img/campaigns/atlantico.jpg', 5000.00, 1200.00, 1, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(2, 1, '2025-12-31', '2026-01-15', 'Campanha Mangais Vivos', 'mocambique', 'Reflorestação de mangais e sensibilização ambiental junto das comunidades costeiras.', 'img/campaigns/mangais.jpg', 3000.00, 800.00, 0, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(3, 1, '2026-01-03', '2026-01-20', 'Campanha Oceano Limpo', 'brasil', 'Ações de limpeza e educação ambiental em praias urbanas e rurais do Brasil.', 'img/campaigns/oceano_limpo.jpg', 4000.00, 1500.00, 0, '2026-01-05 19:31:11', '2026-01-05 19:31:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `name`, `message`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Pedido de informação', 'Ana Marques', 'Gostaria de saber mais informações sobre as doações.', 'ana.marques@email.com', '2025-12-31 19:31:11', '2025-12-31 19:31:11'),
(2, 'Sugestão', 'Tiago Alves', 'Parabéns pelo excelente trabalho que estão a fazer.', 'tiago.alves@email.com', '2026-01-01 19:31:11', '2026-01-01 19:31:11'),
(3, 'Problema no site', 'Carla Pereira', 'Encontrei um erro ao tentar submeter o formulário.', 'carla.pereira@email.com', '2026-01-02 19:31:11', '2026-01-02 19:31:11'),
(4, 'Contacto geral', 'Rui Costa', 'Como posso tornar-me voluntário?', 'rui.costa@email.com', '2026-01-03 19:31:11', '2026-01-03 19:31:11'),
(5, 'Agradecimento', 'Joana Silva', 'Muito obrigado pelo apoio prestado!', 'joana.silva@email.com', '2026-01-04 19:31:11', '2026-01-04 19:31:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `donations`
--

CREATE TABLE `donations` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Anónimo',
  `num_donated` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `donations`
--

INSERT INTO `donations` (`id`, `name`, `num_donated`, `created_at`, `updated_at`) VALUES
(1, 'Ana Marques', 25.00, '2025-12-30 19:31:11', '2025-12-30 19:31:11'),
(2, 'Tiago Alves', 15.50, '2025-12-31 19:31:11', '2025-12-31 19:31:11'),
(3, 'Anónimo', 10.00, '2026-01-01 19:31:11', '2026-01-01 19:31:11'),
(4, 'Carla Pereira', 40.00, '2026-01-02 19:31:11', '2026-01-02 19:31:11'),
(5, 'Rui Costa', 18.75, '2026-01-03 19:31:11', '2026-01-03 19:31:11'),
(6, 'Joana Silva', 32.00, '2026-01-04 19:31:11', '2026-01-04 19:31:11'),
(7, 'Anónimo', 12.00, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(8, 'Marta Rocha', 27.30, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(9, 'Anónimo', 90.00, '2026-01-26 02:56:47', '2026-01-26 02:56:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `event_date`, `event_time`, `location`, `img_path`, `created_at`, `updated_at`, `category_id`, `created_by`) VALUES
(1, 'Limpeza Costeira — Costa da Caparica', 'Limpeza de praia e dunas, com triagem básica (plástico/metal/vidro) e registo de resíduos.', '2026-01-12', '09:30:00', 'Costa da Caparica', 'events/praia_caparica.jpeg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(2, 'Limpeza de Praia — Carcavelos', 'Ação de limpeza com foco em beatas e micro-resíduos. Recomendado levar luvas reutilizáveis.', '2026-01-19', '10:00:00', 'Carcavelos, Lisboa', 'events/praia_carcavelos.jpg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(3, 'Limpeza Costeira — Praia do Guincho', 'Limpeza de areal e arribas (zona acessível). Atenção ao vento: traz casaco e calçado firme.', '2026-01-26', '09:00:00', 'Cascais, Lisboa', 'events/praia_guicho.jpg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(4, 'Limpeza de Praia — Matosinhos', 'Limpeza do areal e passeio marítimo, com separação de recicláveis sempre que possível.', '2026-02-02', '09:30:00', 'Matosinhos, Porto', 'events/praia_matosinhos.jpg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(5, 'Limpeza Costeira — Praia de Faro (Ilha de Faro)', 'Ação na Ria Formosa: recolha de lixo no areal e passadiços, com foco em plásticos leves.', '2026-02-09', '10:30:00', 'Faro, Algarve', 'events/praia_faro.jpg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(6, 'Triagem e Contagem de Resíduos — Pós-Limpezas', 'Sessão para pesar/contar resíduos recolhidos, registar categorias e preparar relatório do mês.', '2026-02-12', '18:00:00', 'Armazém ecoMar, Peniche', 'events/armazem.jpeg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(7, 'Limpeza de Praia — Baleal', 'Limpeza do areal e zonas rochosas acessíveis da Praia do Baleal, com recolha e separação de resíduos.', '2026-02-16', '09:30:00', 'Baleal, Peniche', 'events/praia_baleal.jpg', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1),
(8, 'Limpeza Costeira — Praia da Nazaré', 'Ação de limpeza costeira envolvendo voluntários locais, com foco em plásticos e resíduos de pesca.', '2026-02-23', '10:00:00', 'Nazaré, Leiria', 'events/praia_nazare.webp', '2026-01-05 19:31:11', '2026-01-05 19:31:11', 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_categories`
--

CREATE TABLE `event_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `event_categories`
--

INSERT INTO `event_categories` (`id`, `name`) VALUES
(1, 'Limpezas de Praia e Costeiras'),
(2, 'Educação e Sensibilização Ambiental'),
(3, 'Conservação Marinha'),
(4, 'Ações Comunitárias');

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_registrations`
--

CREATE TABLE `event_registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `event_registrations`
--

INSERT INTO `event_registrations` (`id`, `user_id`, `event_id`, `created_at`) VALUES
(1, 1, 1, '2026-01-26 02:53:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `event_suggestions`
--

CREATE TABLE `event_suggestions` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0000_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_25_161206_create_event_categories_table', 1),
(5, '2025_11_25_161211_create_events_table', 1),
(6, '2025_11_25_161217_create_event_registrations_table', 1),
(7, '2025_11_25_161225_create_event_suggestions_table', 1),
(8, '2025_11_25_161228_create_campaigns_table', 1),
(9, '2025_11_25_161237_create_news_categories_table', 1),
(10, '2025_11_25_161238_create_news_table', 1),
(11, '2025_11_25_161246_create_sponsors_categories_table', 1),
(12, '2025_11_25_161251_create_sponsors_table', 1),
(13, '2025_11_25_161255_create_sponsors_signups_table', 1),
(14, '2025_11_25_161300_create_contacts_table', 1),
(15, '2025_11_25_161307_create_donations_table', 1),
(16, '2025_11_25_161312_create_newsletters_table', 1),
(17, '2025_12_16_150728_create_testimonies_table', 1),
(18, '2025_12_16_172136_create_comments_table', 1),
(19, '2026_01_05_171636_create_sponsor_signups_table', 1),
(20, '2026_01_05_174519_add_signup_id_to_sponsors_table', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `news`
--

CREATE TABLE `news` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `date_upload` datetime NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `newsletters`
--

CREATE TABLE `newsletters` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `newsletters`
--

INSERT INTO `newsletters` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin@mail.com', '2026-01-26 02:55:20', '2026-01-26 02:55:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `news_categories`
--

CREATE TABLE `news_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sponsors`
--

CREATE TABLE `sponsors` (
  `id` bigint UNSIGNED NOT NULL,
  `signup_id` bigint UNSIGNED DEFAULT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('R','A','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P',
  `approved_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sponsors`
--

INSERT INTO `sponsors` (`id`, `signup_id`, `category_id`, `name`, `description`, `img_path`, `status`, `approved_by`) VALUES
(1, NULL, 1, 'Lidl Portugal', 'Apoio a iniciativas de sustentabilidade e responsabilidade ambiental.', 'img/Financeiro1.png', 'R', 1),
(2, NULL, 2, 'WWF', 'Organização internacional dedicada à conservação da natureza e proteção dos oceanos.', 'img/Ambiental1.png', 'R', 1),
(3, NULL, 3, 'Decathlon', 'Apoio com equipamentos e materiais para ações ambientais.', 'img/Logistico1.png', 'R', 1),
(4, NULL, 1, 'Continente', 'Promoção de práticas sustentáveis e proteção ambiental.', 'img/Financeiro2.png', 'R', 1),
(5, NULL, 2, 'ABAE', 'Promove praias limpas e educação ambiental.', 'img/Ambiental2.png', 'R', 1),
(6, NULL, 3, 'Valorsul', 'Gestão de resíduos e apoio logístico a projetos ambientais.', 'img/Logistico2.png', 'R', 1),
(7, NULL, 1, 'Santander Portugal', 'Apoio a projetos de responsabilidade social e sustentabilidade ambiental.', 'img/Financeiro3.png', 'R', 1),
(8, NULL, 2, 'Oceano Azul', 'Proteção dos oceanos e zonas costeiras.', 'img/Ambiental3.png', 'R', 1),
(9, NULL, 3, 'Auchan', 'Apoio com materiais e logística para ações ambientais.', 'img/Logistico3.png', 'R', 1),
(10, NULL, 1, 'fsdf', 'sdfsdfasdfa', NULL, 'R', 1),
(11, NULL, 1, 'fadsffdsadfas', 'dsfsadfadsfadsfdsf', NULL, 'R', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sponsors_categories`
--

CREATE TABLE `sponsors_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sponsors_categories`
--

INSERT INTO `sponsors_categories` (`id`, `name`) VALUES
(1, 'Apoio Financeiro'),
(2, 'Parceiros Ambientais'),
(3, 'Apoio Logístico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sponsors_signups`
--

CREATE TABLE `sponsors_signups` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('R','A','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sponsor_signups`
--

CREATE TABLE `sponsor_signups` (
  `id` bigint UNSIGNED NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `sponsor_signups`
--

INSERT INTO `sponsor_signups` (`id`, `nome`, `email`, `mensagem`, `created_at`, `updated_at`) VALUES
(3, 'dasadsdsasd', 'sdasdasd@masdas.com', 'dfsdsfdfsdfsafads', '2026-01-05 19:39:38', '2026-01-05 19:39:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `testimonies`
--

CREATE TABLE `testimonies` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `testimonies`
--

INSERT INTO `testimonies` (`id`, `user_id`, `message`, `is_approved`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ser voluntário na EcoMar foi uma experiência transformadora. Senti que o meu contributo fez realmente a diferença.', 1, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(2, 2, 'Participar nas ações da EcoMar abriu-me os olhos para a importância da proteção dos oceanos.', 1, '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(3, 3, 'A EcoMar deu-me a oportunidade de aprender, ajudar e conhecer pessoas incríveis com a mesma paixão pelo mar.', 1, '2026-01-05 19:31:11', '2026-01-05 19:31:11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `img_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('A','F','U') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'U',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `location`, `dob`, `img_path`, `email_verified_at`, `password`, `remember_token`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 'admin@mail.com', '912345678', 'Lisboa', NULL, NULL, '2026-01-05 19:31:10', '$2y$12$ELKjLrcimETMCNDRO419bONKp2r4qNYu9vbYdAU7Z.9L3amAB8vsi', NULL, 'A', '2026-01-05 19:31:10', '2026-01-26 03:10:01'),
(2, 'Funcionario', 'funcionario@mail.com', '960000000', 'Porto, Portugal', '1995-05-15', NULL, '2026-01-05 19:31:10', '$2y$12$UKvO6rJoNClD8UNRBvxKR.fu65rdwJsXPKo5rxhsDMgHDdEENLR9e', NULL, 'F', '2026-01-05 19:31:10', '2026-01-05 19:31:10'),
(3, 'Utilizador', 'voluntario@mail.com', NULL, NULL, NULL, NULL, '2026-01-05 19:31:11', '$2y$12$iZuQP/GX7tyWpGhXI.OMiO4ifPOUy8lTS1ah2bR5aHALSHCjkKRPa', NULL, 'U', '2026-01-05 19:31:11', '2026-01-05 19:31:11'),
(4, 'Test User', 'test@example.com', NULL, NULL, NULL, NULL, '2026-01-05 19:31:11', '$2y$12$bTDDmavKYFPSK2BhaVTvy.4OnwIvoR1G8lCel/qh9KUqMUkW6kP26', 'B74wfux6rj', 'U', '2026-01-05 19:31:11', '2026-01-05 19:31:11');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Índices para tabela `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campaigns_user_id_foreign` (`user_id`);

--
-- Índices para tabela `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_category_id_foreign` (`category_id`),
  ADD KEY `events_created_by_foreign` (`created_by`);

--
-- Índices para tabela `event_categories`
--
ALTER TABLE `event_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_registrations_user_id_event_id_unique` (`user_id`,`event_id`),
  ADD KEY `event_registrations_event_id_foreign` (`event_id`);

--
-- Índices para tabela `event_suggestions`
--
ALTER TABLE `event_suggestions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_suggestions_user_id_foreign` (`user_id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Índices para tabela `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_user_id_foreign` (`user_id`),
  ADD KEY `news_category_id_foreign` (`category_id`);

--
-- Índices para tabela `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `newsletters_email_unique` (`email`);

--
-- Índices para tabela `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Índices para tabela `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsors_category_id_foreign` (`category_id`),
  ADD KEY `sponsors_approved_by_foreign` (`approved_by`),
  ADD KEY `sponsors_signup_id_foreign` (`signup_id`);

--
-- Índices para tabela `sponsors_categories`
--
ALTER TABLE `sponsors_categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `sponsors_signups`
--
ALTER TABLE `sponsors_signups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sponsors_signups_category_id_foreign` (`category_id`);

--
-- Índices para tabela `sponsor_signups`
--
ALTER TABLE `sponsor_signups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonies_user_id_foreign` (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `event_categories`
--
ALTER TABLE `event_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `event_registrations`
--
ALTER TABLE `event_registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `event_suggestions`
--
ALTER TABLE `event_suggestions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `sponsors_categories`
--
ALTER TABLE `sponsors_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sponsors_signups`
--
ALTER TABLE `sponsors_signups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sponsor_signups`
--
ALTER TABLE `sponsor_signups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `event_categories` (`id`),
  ADD CONSTRAINT `events_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `event_registrations`
--
ALTER TABLE `event_registrations`
  ADD CONSTRAINT `event_registrations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  ADD CONSTRAINT `event_registrations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `event_suggestions`
--
ALTER TABLE `event_suggestions`
  ADD CONSTRAINT `event_suggestions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `news_categories` (`id`),
  ADD CONSTRAINT `news_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `sponsors`
--
ALTER TABLE `sponsors`
  ADD CONSTRAINT `sponsors_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sponsors_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `sponsors_categories` (`id`),
  ADD CONSTRAINT `sponsors_signup_id_foreign` FOREIGN KEY (`signup_id`) REFERENCES `sponsor_signups` (`id`) ON DELETE SET NULL;

--
-- Limitadores para a tabela `sponsors_signups`
--
ALTER TABLE `sponsors_signups`
  ADD CONSTRAINT `sponsors_signups_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `sponsors_categories` (`id`);

--
-- Limitadores para a tabela `testimonies`
--
ALTER TABLE `testimonies`
  ADD CONSTRAINT `testimonies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
