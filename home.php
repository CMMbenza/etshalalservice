<?php
declare(strict_types=1);

/**
 * Charge les images de la galerie.
 * Dossier attendu : assets/images/galerie/
 */
function chargerImagesGalerie(string $dossier = __DIR__ . '/assets/images/galerie'): array
{
    if (!is_dir($dossier)) {
        return [];
    }

    $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'CR2'];
    $images = [];

    foreach (scandir($dossier) ?: [] as $fichier) {
        if ($fichier === '.' || $fichier === '..') {
            continue;
        }

        $chemin = $dossier . DIRECTORY_SEPARATOR . $fichier;
        $extension = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));

        if (is_file($chemin) && in_array($extension, $extensions, true)) {
            $images[] = 'assets/images/galerie/' . rawurlencode($fichier);
        }
    }

    shuffle($images);
    return $images;
}

$imagesGalerie = chargerImagesGalerie();
?>
<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ets. HALAL SERVICE | Accompagnement PME, Formation & Immobilier à Kinshasa</title>
    <meta name="description" content="Établissement HALAL SERVICE (Ets. HALAL SERVICE) à Kinshasa (Gombe) : accompagnement des PME, business plans, formation, financement et services immobiliers. La richesse c'est avant tout bien se former.">
    
    <!-- Polices Google Fonts : Plus Jakarta Sans (Titres) & Inter (Corps) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icônes Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        halal: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0284c7',
                            600: '#0072BC',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        ivory: {
                            50: '#FAF8F5',
                            100: '#F4F0EA',
                            200: '#E8E1D5',
                        },
                        earth: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(15, 23, 42, 0.07)',
                        'card': '0 20px 45px -15px rgba(0, 114, 188, 0.10)',
                        'glow': '0 12px 30px -6px rgba(0, 114, 188, 0.35)',
                    }
                }
            }
        }
    </script>

    <style>
        /* Motifs géométriques africains subtils (Kente / Bogolan minimaliste) */
        .african-kente-bar {
            height: 5px;
            background: repeating-linear-gradient(
                90deg,
                #0072BC 0px,
                #0072BC 28px,
                #D97706 28px,
                #D97706 42px,
                #0F172A 42px,
                #0F172A 50px,
                #F59E0B 50px,
                #F59E0B 64px
            );
        }

        .african-pattern-bg {
            background-color: #FAF8F5;
            background-image: radial-gradient(#0072BC14 1.25px, transparent 1.25px), radial-gradient(#D9770614 1.25px, #FAF8F5 1.25px);
            background-size: 36px 36px;
            background-position: 0 0, 18px 18px;
        }

        .african-woven-dark {
            background-color: #0F172A;
            background-image: linear-gradient(30deg, #1e293b 12%, transparent 12.5%, transparent 87%, #1e293b 87.5%, #1e293b),
                              linear-gradient(150deg, #1e293b 12%, transparent 12.5%, transparent 87%, #1e293b 87.5%, #1e293b),
                              linear-gradient(60deg, #0072bc18 25%, transparent 25.5%, transparent 75%, #0072bc18 75%, #0072bc18);
            background-size: 48px 84px;
        }

        /* Animations fluides au défilement */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Glassmorphism raffiné */
        .glass-panel {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }
    </style>
</head>
<body class="bg-ivory-50 text-slate-800 antialiased selection:bg-halal-600 selection:text-white overflow-x-hidden">

    <?php require_once('layouts/navbar.php');?>

    <!-- =====================================================================
         3. SECTION HERO ÉDITORIALE ASYMÉTRIQUE
    ====================================================================== -->
    <section id="accueil" class="relative overflow-hidden african-pattern-bg pt-12 pb-20 lg:pt-20 lg:pb-28">
        <!-- Halos lumineux décoratifs -->
        <div class="absolute -top-28 -right-28 w-[28rem] h-[28rem] rounded-full bg-halal-300/25 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 -left-24 w-96 h-96 rounded-full bg-earth-400/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-10 items-center">
                
                <!-- Colonne Texte (7 colonnes) -->
                <div class="lg:col-span-7 space-y-6 reveal active">
                    <div class="inline-flex items-center gap-2.5 bg-white border border-halal-200/90 shadow-sm px-4 py-2 rounded-full">
                        <span class="w-2.5 h-2.5 rounded-full bg-earth-500 animate-pulse"></span>
                        <span class="text-xs sm:text-sm font-bold text-halal-800 tracking-wide">
                            Accompagnement des PME & Immobilier • Kinshasa, RDC
                        </span>
                    </div>

                    <h1 class="font-display font-extrabold text-3xl sm:text-5xl lg:text-[3.35rem] text-slate-900 leading-[1.13] tracking-tight">
                        Propulser les entrepreneurs et bâtir un 
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-halal-600 to-halal-500">écosystème durable</span>.
                    </h1>

                    <!-- Citation / Slogan officiel encadré -->
                    <div class="border-l-4 border-earth-500 pl-4 py-1 bg-white/70 rounded-r-2xl max-w-xl">
                        <p class="font-display font-bold text-halal-700 text-base sm:text-lg italic">
                            « La richesse c'est avant tout bien se former »
                        </p>
                    </div>

                    <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl">
                        L’<strong>Établissement HALAL SERVICE (Ets. HALAL SERVICE)</strong> accompagne les petites et moyennes entreprises (PME), les coopératives de femmes maraîchères et les porteurs de projets à chaque étape de leur développement afin de renforcer leur <strong>compétitivité</strong>, leur <strong>rentabilité</strong> et leur <strong>pérennité</strong>.
                    </p>

                    <!-- Boutons d'action principaux -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <a href="#services" class="inline-flex items-center justify-center gap-2.5 bg-halal-600 hover:bg-halal-700 text-white font-bold px-7 py-4 rounded-2xl shadow-glow transition transform hover:-translate-y-0.5">
                            <span>Découvrir nos 9 pôles de services</span>
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </a>
                        <a href="#contact" class="inline-flex items-center justify-center gap-2.5 bg-white hover:bg-slate-50 text-slate-900 font-bold px-7 py-4 rounded-2xl border border-slate-200 shadow-soft transition">
                            <i class="fa-solid fa-calendar-check text-earth-600"></i>
                            <span>Prendre rendez-vous</span>
                        </a>
                    </div>

                    <!-- Indicateurs de confiance -->
                    <div class="grid grid-cols-3 gap-4 pt-6 border-t border-slate-200/80 max-w-xl">
                        <div>
                            <p class="font-display font-extrabold text-2xl sm:text-3xl text-halal-600">360°</p>
                            <p class="text-xs sm:text-sm font-medium text-slate-600">Accompagnement PME</p>
                        </div>
                        <div>
                            <p class="font-display font-extrabold text-2xl sm:text-3xl text-earth-600">9 Pôles</p>
                            <p class="text-xs sm:text-sm font-medium text-slate-600">Conseil & Immobilier</p>
                        </div>
                        <div>
                            <p class="font-display font-extrabold text-2xl sm:text-3xl text-slate-900">Gombe</p>
                            <p class="text-xs sm:text-sm font-medium text-slate-600">Ancrage à Kinshasa</p>
                        </div>
                    </div>
                </div>

                <!-- Colonne Composition Visuelle (5 colonnes) -->
                <div class="lg:col-span-5 relative reveal active">
                    <div class="relative rounded-[2rem] overflow-hidden shadow-card border-[6px] border-white bg-white">
                        <img 
                            src="assets/images/galerie/WhatsApp Image 2026-11-06 at 17.15.16.jpeg" 
                            onerror="this.onerror=null;this.src='https://placehold.co/800x950/0072BC/ffffff?text=Femmes+Maraicheres+Africaines';"
                            alt="Femme noire africaine maraîchère dans son champ verdoyant accompagnée par Ets. HALAL SERVICE" 
                            class="w-full h-[410px] sm:h-[490px] object-cover object-center"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-900/20 to-transparent"></div>
                        
                        <!-- Légende intégrée en bas de photo -->
                        <div class="absolute bottom-5 left-5 right-5 text-white">
                            <span class="inline-block bg-earth-500 text-slate-950 text-[11px] font-extrabold uppercase tracking-wider px-3 py-1 rounded-full mb-2">
                                Impact Terrain & Agri-PME
                            </span>
                            <p class="font-display font-bold text-lg sm:text-xl leading-snug">
                                Autonomisation des femmes maraîchères et structuration des PME locales
                            </p>
                        </div>
                    </div>

                    <!-- Carte flottante supérieure droite -->
                    <div class="hidden sm:flex items-center gap-3.5 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-slate-100 absolute -top-5 -right-5 max-w-[250px]">
                        <div class="w-11 h-11 rounded-xl bg-halal-50 text-halal-600 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-seedling"></i>
                        </div>
                        <div>
                            <p class="text-xs font-extrabold text-slate-900">Croissance Durable</p>
                            <p class="text-[11px] text-slate-500 leading-tight mt-0.5">De l'idée au financement et à l'expansion</p>
                        </div>
                    </div>

                    <!-- Carte flottante inférieure gauche -->
                    <div class="hidden sm:flex items-center gap-3.5 bg-slate-900 text-white p-4 rounded-2xl shadow-xl border border-slate-700 absolute -bottom-5 -left-6 max-w-[270px]">
                        <div class="w-11 h-11 rounded-xl bg-earth-500 text-slate-950 flex items-center justify-center text-lg flex-shrink-0">
                            <i class="fa-solid fa-building-shield"></i>
                        </div>
                        <div>
                            <p class="text-xs font-extrabold text-white">Conseil & Immobilier</p>
                            <p class="text-[11px] text-slate-300 leading-tight mt-0.5">Solutions d'affaires et patrimoine à Kinshasa</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SECTION IMPACT : ENTREPRENEURS ACCOMPAGNÉS -->
    <section class="relative py-12 sm:py-16 bg-slate-950 overflow-hidden">
        <div class="absolute inset-0 african-woven-dark opacity-60"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                <div class="md:col-span-8 text-center md:text-left">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-earth-400 mb-3">
                        <i class="fa-solid fa-chart-line"></i> Notre impact sur le terrain
                    </span>
                    <h2 class="font-display font-extrabold text-2xl sm:text-3xl lg:text-4xl text-white leading-tight">
                        Ils ont accompagné plus de
                        <span class="text-earth-400">350 entrepreneurs locaux</span> en RDC
                    </h2>
                    <p class="mt-3 text-sm sm:text-base text-slate-300 max-w-2xl">
                        Un engagement concret pour soutenir les initiatives locales, renforcer les PME et faire grandir l'entrepreneuriat congolais.
                    </p>
                </div>
                <div class="md:col-span-4 flex justify-center md:justify-end">
                    <div class="rounded-2xl border border-white/15 bg-white/10 backdrop-blur px-8 py-5 text-center shadow-xl min-w-44">
                        <div class="font-display font-extrabold text-5xl sm:text-6xl text-earth-400">350<span class="text-3xl">+</span></div>
                        <div class="mt-1 text-xs font-bold uppercase tracking-wider text-white">Entrepreneurs accompagnés</div>
                        <div class="mt-2 text-[11px] text-slate-300">En République démocratique du Congo</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         4. SECTION À PROPOS (VISION, MISSION & VALEURS)
    ====================================================================== -->
    <section id="apropos" class="py-20 lg:py-28 bg-white border-y border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
                
                <!-- Visuel gauche -->
                <div class="lg:col-span-5 reveal">
                    <div class="relative">
                        <div class="rounded-[2rem] overflow-hidden shadow-soft border border-slate-100">
                            <img 
                                src="http://localhost/halal/assets/images/galerie/WhatsApp Image 2026-11-06 at 17.15.10.jpeg" 
                                onerror="this.onerror=null;this.src='https://placehold.co/800x700/0369a1/ffffff?text=Entrepreneurs+Africains+PME';"
                                alt="Entrepreneurs et dirigeants noirs africains en séance stratégique chez Ets. HALAL SERVICE" 
                                class="w-full h-[380px] sm:h-[440px] object-cover"
                            >
                        </div>
                        <!-- Encart accent africain -->
                        <div class="mt-4 sm:mt-0 sm:absolute sm:-bottom-6 sm:right-6 bg-halal-600 text-white p-6 rounded-2xl shadow-card max-w-xs">
                            <div class="flex items-center gap-3 mb-2">
                                <i class="fa-solid fa-hands-holding-circle text-2xl text-earth-400"></i>
                                <span class="font-display font-bold text-base">Notre Philosophie</span>
                            </div>
                            <p class="text-xs sm:text-sm text-halal-50 leading-relaxed">
                                Des mains unies qui font grandir l'arbre de la connaissance et de la prospérité entrepreneuriale.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contenu éditorial droite -->
                <div class="lg:col-span-7 space-y-6 reveal">
                    <div class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-halal-600 bg-halal-50 px-3.5 py-1.5 rounded-full">
                        <i class="fa-solid fa-compass"></i> À propos de l’entreprise
                    </div>
                    
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                        Un partenaire stratégique dédié à la réussite des PME congolaises
                    </h2>
                    
                    <p class="text-slate-600 text-base sm:text-lg leading-relaxed">
                        Implanté au cœur de la commune de la Gombe à Kinshasa, l’<strong>Établissement HALAL SERVICE (Ets. HALAL SERVICE)</strong> s'est donné pour mission d'accompagner les petites et moyennes entreprises (PME) à chaque étape charnière de leur cycle de vie.
                    </p>
                    
                    <p class="text-slate-600 text-base leading-relaxed">
                        Convaincus que la formation et la structuration sont les véritables leviers de création de valeur, nous bâtissons un <strong>écosystème dynamique d'entrepreneurs</strong> — des initiatives agricoles et maraîchères portées par les femmes jusqu'aux entreprises de services et projets immobiliers.
                    </p>

                    <!-- 3 Piliers -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-3">
                        <div class="p-5 rounded-2xl bg-ivory-50 border border-ivory-200/80">
                            <div class="w-10 h-10 rounded-xl bg-halal-600 text-white flex items-center justify-center mb-3">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Compétitivité</h3>
                            <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Structuration interne et stratégie commerciale adaptée aux réalités du marché.</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-ivory-50 border border-ivory-200/80">
                            <div class="w-10 h-10 rounded-xl bg-earth-600 text-white flex items-center justify-center mb-3">
                                <i class="fa-solid fa-coins"></i>
                            </div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Rentabilité</h3>
                            <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Business plans bancables, maîtrise financière et accès aux financements.</p>
                        </div>

                        <div class="p-5 rounded-2xl bg-ivory-50 border border-ivory-200/80">
                            <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center mb-3">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <h3 class="font-display font-bold text-slate-900 text-base">Pérennité</h3>
                            <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">Formalisation administrative, mentorat continu et sécurisation patrimoniale.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         5. SECTION NOS SERVICES (GRILLE BENTO DES 9 PÔLES OFFICIELS)
    ====================================================================== -->
    <section id="services" class="py-20 lg:py-28 african-pattern-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- En-tête de section -->
            <div class="text-center max-w-3xl mx-auto mb-16 reveal">
                <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-halal-700 bg-white border border-halal-200 px-4 py-1.5 rounded-full shadow-sm mb-4">
                    <i class="fa-solid fa-briefcase text-earth-600"></i> Nos Missions & Domaines d'Expertise
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900 leading-tight">
                    9 pôles d'accompagnement sur mesure pour votre croissance
                </h2>
                <p class="text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                    De la création et la structuration de votre entreprise jusqu'au développement de votre patrimoine immobilier, Ets. HALAL SERVICE mobilise une expertise complète.
                </p>
            </div>

            <!-- Grille des 8 premiers services -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Service 01 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-magnifying-glass-chart"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">01</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Diagnostic et structuration de l’entreprise
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Audit organisationnel complet, identification des leviers d'amélioration et mise en place de procédures de gestion efficaces.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Diagnostic et structuration de l’entreprise')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Demander un diagnostic</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 02 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-file-signature"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">02</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Élaboration de business plans et plans stratégiques
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Rédaction d'études de faisabilité, projections financières solides et feuilles de route stratégiques orientées résultats.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Élaboration de business plan et plan stratégique')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Lancer mon business plan</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 03 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-stamp"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">03</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Formalisation et accompagnement administratif
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Assistance complète dans les démarches légales, immatriculation RCCM, obtention d'agréments et conformité réglementaire en RDC.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Formalisation et accompagnement administratif')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Formaliser mon activité</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 04 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-earth-50 group-hover:bg-earth-600 text-earth-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-earth-600 transition-colors">04</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Formation et renforcement des capacités des dirigeants
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Séminaires pratiques en gestion financière, leadership, comptabilité simplifiée et management d'équipe.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Formation et renforcement des capacités')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-earth-600 group-hover:text-earth-700">
                        <span>Voir le calendrier</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 05 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">05</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Coaching entrepreneurial et mentorat
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Accompagnement individuel des porteurs de projets et femmes entrepreneures pour lever les blocages opérationnels.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Coaching entrepreneurial et mentorat')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Réserver un coaching</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 06 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-handshake-angle"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">06</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Accès aux opportunités de financement et partenariats
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Mise en relation avec des institutions financières, bailleurs, programmes d'appui et partenaires commerciaux stratégiques.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Accès au financement et aux partenariats')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Préparer mon dossier</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 07 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">07</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Développement commercial et stratégie
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Conquête de nouveaux marchés, positionnement d'offre, force de vente et fidélisation durable de votre clientèle.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Développement commercial et stratégie')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Booster mes ventes</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>

                <!-- Service 08 -->
                <div class="group bg-white rounded-3xl p-7 border border-slate-200/80 shadow-soft hover:shadow-card hover:border-halal-300 transition-all duration-300 flex flex-col justify-between reveal">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-12 h-12 rounded-2xl bg-halal-50 group-hover:bg-halal-600 text-halal-600 group-hover:text-white flex items-center justify-center text-xl transition-colors">
                                <i class="fa-solid fa-chart-pie"></i>
                            </div>
                            <span class="font-display font-extrabold text-sm text-slate-300 group-hover:text-halal-600 transition-colors">08</span>
                        </div>
                        <h3 class="font-display font-bold text-lg text-slate-900 mb-2.5 leading-snug">
                            Suivi personnalisé pour assurer une croissance durable
                        </h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Tableaux de bord périodiques, évaluations sur le terrain et ajustements continus pour sécuriser vos performances.
                        </p>
                    </div>
                    <a href="#contact" onclick="selectSubject('Suivi personnalisé de croissance durable')" class="mt-6 inline-flex items-center gap-1.5 text-xs font-bold text-halal-600 group-hover:text-halal-800">
                        <span>Bénéficier d'un suivi</span>
                        <i class="fa-solid fa-arrow-right text-[11px] transition-transform group-hover:translate-x-1"></i>
                    </a>
                </div>
            </div>

            <!-- Pôle 09 : IMMOBILIER (Carte vedette pleine largeur) -->
            <div class="mt-8 rounded-[2rem] african-woven-dark text-white p-8 sm:p-10 lg:p-12 shadow-2xl border border-slate-800 relative overflow-hidden reveal">
                <div class="absolute top-0 right-0 w-80 h-80 bg-halal-600/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    <div class="lg:col-span-8 space-y-4">
                        <div class="inline-flex items-center gap-2 bg-earth-500/20 border border-earth-400/40 text-earth-300 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider">
                            <span>Pôle 09 • Département Immobilier</span>
                        </div>
                        <h3 class="font-display font-extrabold text-2xl sm:text-3xl text-white">
                            Services Immobiliers : Location, Vente de Terrains & Gestion
                        </h3>
                        <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                            En complément de l’appui aux entreprises, l’<strong>Ets. HALAL SERVICE</strong> vous accompagne dans tous vos projets immobiliers à Kinshasa et en RDC avec rigueur, transparence et sécurité juridique.
                        </p>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2">
                            <div class="flex items-center gap-2.5 bg-white/5 border border-white/10 px-4 py-3 rounded-xl">
                                <i class="fa-solid fa-house-chimney text-halal-400"></i>
                                <span class="text-xs sm:text-sm font-semibold">Location maisons & appartements</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-white/5 border border-white/10 px-4 py-3 rounded-xl">
                                <i class="fa-solid fa-map-location-dot text-earth-400"></i>
                                <span class="text-xs sm:text-sm font-semibold">Vente de terrains sécurisés</span>
                            </div>
                            <div class="flex items-center gap-2.5 bg-white/5 border border-white/10 px-4 py-3 rounded-xl">
                                <i class="fa-solid fa-key text-emerald-400"></i>
                                <span class="text-xs sm:text-sm font-semibold">Conseil & gestion immobilière</span>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-span-4 flex flex-col sm:flex-row lg:flex-col gap-3 justify-end">
                        <a href="#contact" onclick="selectSubject('Pôle Immobilier : Location / Achat de terrain')" class="w-full text-center bg-earth-500 hover:bg-earth-400 text-slate-950 font-extrabold px-6 py-4 rounded-2xl shadow-lg transition">
                            <i class="fa-solid fa-building mr-2"></i> Soumettre un besoin immobilier
                        </a>
                        <a href="tel:+243897230488" class="w-full text-center bg-white/10 hover:bg-white/20 text-white font-semibold px-6 py-3.5 rounded-2xl border border-white/15 transition text-sm">
                            <i class="fa-solid fa-phone mr-2 text-halal-300"></i> Appeler un conseiller immo
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =====================================================================
         6. SECTION NOS PRODUITS & NOS OFFRES (AVEC ESPACE ROLL-UP / PROSPECTUS)
    ====================================================================== -->
    <section id="produits" class="py-20 lg:py-28 bg-white border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-14 gap-6 reveal">
                <div class="max-w-2xl">
                    <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-earth-700 bg-earth-50 border border-earth-200 px-3.5 py-1.5 rounded-full mb-3">
                        <i class="fa-solid fa-box-open"></i> Nos Produits & Nos Offres
                    </span>
                    <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900">
                        Programmes, Packs PME & Supports Officiels
                    </h2>
                </div>
                <p class="text-slate-600 text-sm sm:text-base max-w-md">
                    Découvrez nos formules d'accompagnement structurées ainsi que les supports issus des roll-ups et prospectus officiels de l'Ets. HALAL SERVICE.
                </p>
            </div>

            <!-- 3 Offres Phares -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Offre 1 : Pack Création & Formalisation -->
                <div class="rounded-3xl border border-slate-200 bg-ivory-50/70 p-8 flex flex-col justify-between hover:shadow-card transition duration-300 reveal">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-halal-100 text-halal-800 text-xs font-extrabold px-3 py-1 rounded-full">Pack Démarrage</span>
                            <i class="fa-solid fa-rocket text-2xl text-halal-600"></i>
                        </div>
                        <h3 class="font-display font-extrabold text-xl text-slate-900 mb-3">
                            Formalisation & Structuration PME
                        </h3>
                        <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                            Idéal pour les entrepreneurs et coopératives souhaitant lancer ou régulariser leur activité sur des bases solides.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-700 mb-8">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Diagnostic initial complet de l'activité</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Accompagnement administratif & immatriculation</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Mise en place des outils de gestion de base</span>
                            </li>
                        </ul>
                    </div>
                    <a href="#contact" onclick="selectSubject('Offre : Pack Formalisation & Structuration PME')" class="w-full text-center bg-white hover:bg-halal-600 text-halal-700 hover:text-white border-2 border-halal-600 font-bold py-3.5 rounded-xl transition">
                        Souscrire à ce programme
                    </a>
                </div>

                <!-- Offre 2 : Programme Croissance & Financement (Mise en avant) -->
                <div class="rounded-3xl border-2 border-halal-600 bg-white p-8 flex flex-col justify-between shadow-card relative reveal">
                    <div class="absolute -top-3.5 right-6 bg-earth-500 text-slate-950 text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-1 rounded-full shadow-sm">
                        Programme Phare
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-halal-600 text-white text-xs font-extrabold px-3 py-1 rounded-full">Croissance & Capital</span>
                            <i class="fa-solid fa-award text-2xl text-earth-500"></i>
                        </div>
                        <h3 class="font-display font-extrabold text-xl text-slate-900 mb-3">
                            Business Plan, Formation & Accès Financement
                        </h3>
                        <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                            Notre offre intégrale combinant montée en compétences des dirigeants et préparation aux opportunités de financement.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-700 mb-8">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-earth-600 mt-1"></i>
                                <span>Élaboration du Business Plan & Plan Stratégique</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-earth-600 mt-1"></i>
                                <span>Formation pratique & coaching entrepreneurial</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-earth-600 mt-1"></i>
                                <span>Mise en relation partenaires & bailleurs</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-earth-600 mt-1"></i>
                                <span>Suivi personnalisé sur le terrain</span>
                            </li>
                        </ul>
                    </div>
                    <a href="#contact" onclick="selectSubject('Offre : Programme Business Plan, Formation & Financement')" class="w-full text-center bg-halal-600 hover:bg-halal-700 text-white font-bold py-3.5 rounded-xl shadow-glow transition">
                        Demander une étude personnalisée
                    </a>
                </div>

                <!-- Offre 3 : Catalogue Immobilier & Patrimoine -->
                <div class="rounded-3xl border border-slate-200 bg-ivory-50/70 p-8 flex flex-col justify-between hover:shadow-card transition duration-300 reveal">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="bg-slate-900 text-white text-xs font-extrabold px-3 py-1 rounded-full">Solutions Immo</span>
                            <i class="fa-solid fa-city text-2xl text-halal-600"></i>
                        </div>
                        <h3 class="font-display font-extrabold text-xl text-slate-900 mb-3">
                            Offres Immobilières & Foncières
                        </h3>
                        <p class="text-sm text-slate-600 mb-6 leading-relaxed">
                            Un accompagnement de proximité pour loger votre famille, implanter vos bureaux ou investir dans le foncier.
                        </p>
                        <ul class="space-y-3 text-sm text-slate-700 mb-8">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Maisons et appartements en location à Kinshasa</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Vente de terrains avec vérification documentaire</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-circle-check text-halal-600 mt-1"></i>
                                <span>Recherche ciblée de locaux commerciaux</span>
                            </li>
                        </ul>
                    </div>
                    <a href="#contact" onclick="selectSubject('Offre : Consultation Catalogue Immobilier')" class="w-full text-center bg-white hover:bg-halal-600 text-halal-700 hover:text-white border-2 border-halal-600 font-bold py-3.5 rounded-xl transition">
                        Consulter les biens disponibles
                    </a>
                </div>

            </div>

            <!-- Espace Interactif : Vitrine Roll-Up & Prospectus Officiels -->
            <div class="mt-14 rounded-3xl bg-gradient-to-br from-halal-50 via-white to-earth-50 border border-halal-200 p-6 sm:p-10 shadow-soft reveal">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <div class="lg:col-span-7 space-y-4">
                        <div class="inline-flex items-center gap-2 bg-white border border-halal-200 px-3 py-1 rounded-full text-xs font-extrabold text-halal-700">
                            <i class="fa-solid fa-file-invoice text-earth-600"></i> Vitrine Roll-Up & Prospectus Officiels
                        </div>
                        <h3 class="font-display font-extrabold text-2xl text-slate-900">
                            Documentation Commerciale & Fiches Programmes Ets. HALAL SERVICE
                        </h3>
                        <p class="text-sm sm:text-base text-slate-600 leading-relaxed">
                            Retrouvez ici les visuels officiels issus des roll-ups et prospectus de l’Établissement HALAL SERVICE. Vous pouvez prévisualiser la fiche récapitulative ou demander l'envoi immédiat de nos brochures par e-mail ou WhatsApp.
                        </p>
                        <div class="flex flex-wrap gap-3 pt-2">
                            <button onclick="openProspectusPreview()" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold px-5 py-3 rounded-xl transition">
                                <i class="fa-solid fa-eye text-earth-400"></i> Aperçu du Roll-Up Officiel
                            </button>
                            <a href="#contact" onclick="selectSubject('Demande des prospectus officiels Ets. HALAL SERVICE')" class="inline-flex items-center gap-2 bg-halal-600 hover:bg-halal-700 text-white text-sm font-bold px-5 py-3 rounded-xl shadow-sm transition">
                                <i class="fa-solid fa-paper-plane"></i> Recevoir les prospectus PDF
                            </a>
                        </div>
                    </div>

                    <!-- Mini-aperçu visuel Roll-up -->
                    <div class="lg:col-span-5">
                        <div id="rollup-card-preview" onclick="openProspectusPreview()" class="cursor-pointer group bg-white rounded-2xl border border-slate-200 p-5 shadow-md hover:shadow-xl transition relative overflow-hidden">
                            <div class="african-kente-bar -mx-5 -mt-5 mb-4"></div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-halal-600">Support Officiel</span>
                                <span class="text-xs text-slate-400 group-hover:text-halal-600 transition"><i class="fa-solid fa-expand"></i> Agrandir</span>
                            </div>
                            <h4 class="font-display font-extrabold text-base text-slate-900">Ets. HALAL SERVICE — Kinshasa</h4>
                            <p class="text-xs text-earth-700 font-semibold italic mt-0.5">« La richesse c'est avant tout bien se former »</p>
                            <div class="mt-3 pt-3 border-t border-slate-100 grid grid-cols-2 gap-2 text-[11px] text-slate-600">
                                <span>• Conseil & Structuration PME</span>
                                <span>• Business Plans & Stratégie</span>
                                <span>• Formation & Coaching</span>
                                <span>• Immobilier & Terrains</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- =====================================================================
         7. SECTION RÉALISATIONS, GALERIE PHOTOS & ACTUALITÉS
    ====================================================================== -->
    <section id="realisations" class="py-20 lg:py-28 african-pattern-bg border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- En-tête Galerie -->
            <div class="text-center max-w-3xl mx-auto mb-12 reveal">
                <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-halal-700 bg-white border border-halal-200 px-4 py-1.5 rounded-full shadow-sm mb-3">
                    <i class="fa-solid fa-images text-earth-600"></i> Terrain & Impact
                </span>
                <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900">
                    Nos Réalisations & Galerie Photos
                </h2>
                <p class="text-slate-600 text-base mt-3">
                    Aux côtés des femmes maraîchères, des dirigeants de PME et des investisseurs immobiliers à Kinshasa.
                </p>

                <!-- Filtres de la galerie -->
                <!-- <div class="flex flex-wrap justify-center gap-2.5 mt-7">
                    <button class="gallery-filter active bg-halal-600 text-white px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold shadow-sm transition" data-filter="all">Tout voir</button>
                    <button class="gallery-filter bg-white text-slate-700 hover:bg-halal-50 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold border border-slate-200 transition" data-filter="maraicheres">Femmes maraîchères</button>
                    <button class="gallery-filter bg-white text-slate-700 hover:bg-halal-50 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold border border-slate-200 transition" data-filter="formation">Formations & Coaching</button>
                    <button class="gallery-filter bg-white text-slate-700 hover:bg-halal-50 px-5 py-2.5 rounded-full text-xs sm:text-sm font-bold border border-slate-200 transition" data-filter="immobilier">Immobilier & Projets</button>
                </div> -->
            </div>

            <!-- Galerie dynamique : photos aléatoires du dossier assets/images/galerie/ -->
            <div class="relative reveal">
                <?php if (!empty($imagesGalerie)): ?>
                    <div id="gallery-slider" class="flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-5" aria-label="Galerie de réalisations">
                        <?php foreach (array_slice($imagesGalerie, 0, 12) as $index => $image): ?>
                            <article class="gallery-slide group relative flex-none w-[82%] sm:w-[48%] lg:w-[31.5%] snap-start overflow-hidden rounded-3xl border-4 border-white bg-white shadow-soft aspect-[4/3]">
                                <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                                     alt="Réalisation de Ets. HALAL SERVICE"
                                     loading="lazy"
                                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-900/10 to-transparent flex flex-col justify-end p-6 text-white pointer-events-none">
                                    <span class="text-[11px] font-extrabold text-earth-400 uppercase tracking-wider">Nos réalisations</span>
                                    <h3 class="font-display font-bold text-lg mt-1">Ets. HALAL SERVICE</h3>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                    <div class="flex items-center justify-center gap-3 mt-3">
                        <button type="button" id="gallery-prev" aria-label="Photos précédentes" class="w-11 h-11 rounded-full bg-white border border-slate-200 text-halal-700 hover:bg-halal-600 hover:text-white transition shadow-sm">
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <span class="text-xs text-slate-500 font-semibold">Faites défiler pour découvrir nos activités</span>
                        <button type="button" id="gallery-next" aria-label="Photos suivantes" class="w-11 h-11 rounded-full bg-white border border-slate-200 text-halal-700 hover:bg-halal-600 hover:text-white transition shadow-sm">
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                <?php else: ?>
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
                        <i class="fa-regular fa-images text-3xl text-halal-600 mb-3"></i>
                        <p class="font-semibold">Aucune photo disponible pour le moment.</p>
                        <!-- <p class="text-sm mt-1">Ajoutez vos images dans le dossier <code>asset/images/galerie/</code>.</p> -->
                    </div>
                <?php endif; ?>
                <div class="text-center mt-8">
                    <a href="nos-realisations.php" class="inline-flex items-center justify-center gap-2 bg-halal-600 hover:bg-halal-700 text-white font-bold px-7 py-3.5 rounded-xl shadow-glow transition">
                        Voir plus de réalisations <i class="fa-solid fa-arrow-right text-sm"></i>
                    </a>
                </div>
            </div>

            <!-- Fil d'Actualités & Publications -->
            <div class="mt-20 bg-white rounded-[2rem] p-8 sm:p-10 border border-slate-200/80 shadow-soft reveal">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-halal-600">Journal & Annonces</span>
                        <h3 class="font-display font-extrabold text-2xl text-slate-900 mt-0.5">
                            Actualités de l’Ets. HALAL SERVICE
                        </h3>
                    </div>
                    <button onclick="openAdminModal()" class="inline-flex items-center gap-2 text-xs font-bold bg-halal-50 hover:bg-halal-600 text-halal-700 hover:text-white px-4 py-2.5 rounded-xl border border-halal-200 transition self-start sm:self-auto">
                        <i class="fa-solid fa-plus"></i>
                        <span>Publier une actualité (Admin)</span>
                    </button>
                </div>

                <div id="news-container" class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                    <!-- Actu 1 -->
                    <article class="rounded-2xl border border-slate-200/80 bg-ivory-50/60 p-6 flex flex-col justify-between hover:border-halal-300 transition">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-3">
                                <span><i class="fa-regular fa-calendar text-halal-600 mr-1"></i> Programme 2026</span>
                                <span class="bg-halal-100 text-halal-800 px-2.5 py-0.5 rounded-full text-[11px] font-bold">Formation PME</span>
                            </div>
                            <h4 class="font-display font-bold text-lg text-slate-900 mb-2">
                                Lancement des sessions de renforcement des capacités des dirigeants
                            </h4>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Inscriptions ouvertes à notre siège de Gombe pour les modules pratiques en gestion financière, stratégie commerciale et formalisation d'entreprise.
                            </p>
                        </div>
                        <a href="#contact" onclick="selectSubject('Inscription session de formation PME')" class="mt-5 inline-flex items-center gap-1.5 text-xs font-extrabold text-halal-700 hover:text-halal-900">
                            <span>S'inscrire maintenant</span> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </article>

                    <!-- Actu 2 -->
                    <article class="rounded-2xl border border-slate-200/80 bg-ivory-50/60 p-6 flex flex-col justify-between hover:border-earth-300 transition">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-3">
                                <span><i class="fa-regular fa-calendar text-earth-600 mr-1"></i> Terrain Kinshasa</span>
                                <span class="bg-earth-100 text-earth-800 px-2.5 py-0.5 rounded-full text-[11px] font-bold">Femmes Maraîchères</span>
                            </div>
                            <h4 class="font-display font-bold text-lg text-slate-900 mb-2">
                                Accompagnement des groupements de femmes maraîchères
                            </h4>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Structuration en coopératives, tenue de comptabilité simplifiée et mise en relation avec des partenaires pour accroître leur rentabilité.
                            </p>
                        </div>
                        <a href="#contact" onclick="selectSubject('Programme d’appui aux femmes maraîchères')" class="mt-5 inline-flex items-center gap-1.5 text-xs font-extrabold text-earth-700 hover:text-earth-900">
                            <span>Découvrir l'initiative</span> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </article>

                    <!-- Actu 3 -->
                    <article class="rounded-2xl border border-slate-200/80 bg-ivory-50/60 p-6 flex flex-col justify-between hover:border-halal-300 transition">
                        <div>
                            <div class="flex items-center justify-between text-xs text-slate-500 font-semibold mb-3">
                                <span><i class="fa-regular fa-calendar text-halal-600 mr-1"></i> Pôle Immobilier</span>
                                <span class="bg-slate-200 text-slate-800 px-2.5 py-0.5 rounded-full text-[11px] font-bold">Nouvelles Offres</span>
                            </div>
                            <h4 class="font-display font-bold text-lg text-slate-900 mb-2">
                                Nouvelles opportunités de location et vente de terrains
                            </h4>
                            <p class="text-sm text-slate-600 leading-relaxed">
                                Découvrez notre sélection actualisée d'appartements, maisons et terrains vérifiés disponibles immédiatement via Ets. HALAL SERVICE.
                            </p>
                        </div>
                        <a href="#contact" onclick="selectSubject('Demande d’informations sur les nouvelles offres immobilières')" class="mt-5 inline-flex items-center gap-1.5 text-xs font-extrabold text-slate-900 hover:text-halal-600">
                            <span>Contacter le service immo</span> <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </article>
                </div>
            </div>

        </div>
    </section>

    <!-- =====================================================================
         8. SECTION NOS PARTENAIRES
    ====================================================================== -->
    <section id="partenaires" class="py-16 lg:py-24 bg-white border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12 reveal">
                <span class="text-xs font-extrabold uppercase tracking-widest text-halal-600">Écosystème & Synergies</span>
                <h2 class="font-display font-extrabold text-3xl text-slate-900 mt-2">
                    Nos Partenaires & Réseau d'Appui
                </h2>
                <p class="text-slate-600 text-sm sm:text-base mt-3">
                    Nous collaborons avec un réseau diversifié d'acteurs pour faciliter l'accès des PME au financement, aux marchés et à la formation.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 reveal">
                <div class="p-6 rounded-2xl border border-slate-200/80 bg-ivory-50/50 text-center hover:border-halal-300 transition">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-halal-100 text-halal-700 flex items-center justify-center text-xl mb-3">
                        <i class="fa-solid fa-landmark"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Institutions Financières</h3>
                    <p class="text-xs text-slate-600 mt-1.5">Banques, institutions de microfinance et fonds d'appui aux PME.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-200/80 bg-ivory-50/50 text-center hover:border-earth-300 transition">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-earth-100 text-earth-700 flex items-center justify-center text-xl mb-3">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Coopératives Agricoles</h3>
                    <p class="text-xs text-slate-600 mt-1.5">Associations de femmes maraîchères et groupements agro-pastoraux.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-200/80 bg-ivory-50/50 text-center hover:border-halal-300 transition">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-halal-100 text-halal-700 flex items-center justify-center text-xl mb-3">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Centres de Formation</h3>
                    <p class="text-xs text-slate-600 mt-1.5">Experts-comptables, formateurs certifiés et cabinets conseils.</p>
                </div>

                <div class="p-6 rounded-2xl border border-slate-200/80 bg-ivory-50/50 text-center hover:border-slate-400 transition">
                    <div class="w-12 h-12 mx-auto rounded-2xl bg-slate-200 text-slate-800 flex items-center justify-center text-xl mb-3">
                        <i class="fa-solid fa-building-user"></i>
                    </div>
                    <h3 class="font-display font-bold text-slate-900 text-base">Promoteurs & Agences</h3>
                    <p class="text-xs text-slate-600 mt-1.5">Acteurs du secteur immobilier, foncier et aménagement urbain.</p>
                </div>
            </div>

            <div class="mt-10 text-center reveal">
                <a href="#contact" onclick="selectSubject('Proposition de partenariat avec Ets. HALAL SERVICE')" class="inline-flex items-center gap-2 text-sm font-bold text-halal-700 hover:text-halal-900 bg-halal-50 hover:bg-halal-100 px-6 py-3 rounded-xl border border-halal-200 transition">
                    <i class="fa-solid fa-handshake"></i>
                    <span>Devenir partenaire de l’Ets. HALAL SERVICE</span>
                </a>
            </div>
        </div>
    </section>

    <!-- =====================================================================
         9. SECTION CONTACT & LOCALISATION (GOMBE, KINSHASA)
    ====================================================================== -->
    <section id="contact" class="py-20 lg:py-28 african-pattern-bg border-t border-slate-200/70">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">
                
                <!-- Colonne Informations de Contact (5 colonnes) -->
                <div class="lg:col-span-5 space-y-6 reveal">
                    <div>
                        <span class="inline-flex items-center gap-2 text-xs font-extrabold uppercase tracking-widest text-halal-700 bg-white border border-halal-200 px-3.5 py-1.5 rounded-full mb-3">
                            <i class="fa-solid fa-headset text-earth-600"></i> Contact & Siège Social
                        </span>
                        <h2 class="font-display font-extrabold text-3xl sm:text-4xl text-slate-900">
                            Parlons de votre projet d’entreprise ou immobilier
                        </h2>
                        <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                            Notre équipe vous accueille à Kinshasa (Gombe) et répond rapidement à toutes vos demandes par téléphone, WhatsApp ou e-mail.
                        </p>
                    </div>

                    <!-- Cartes Coordonnées -->
                    <div class="space-y-4">
                        <!-- Adresse -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-soft flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-halal-50 text-halal-600 flex items-center justify-center text-lg flex-shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-bold text-slate-900 text-sm">Adresse physique</h3>
                                <p class="text-sm text-slate-600 mt-1 leading-relaxed">
                                    Avenue Adama, n°16, Quartier Socimat,<br>
                                    Commune de la Gombe, Kinshasa<br>
                                    <span class="font-semibold text-halal-700">(En face de Brussels Airlines)</span>
                                </p>
                            </div>
                        </div>

                        <!-- Téléphones & WhatsApp -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-soft flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-earth-50 text-earth-600 flex items-center justify-center text-lg flex-shrink-0">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div class="w-full">
                                <h3 class="font-display font-bold text-slate-900 text-sm">Téléphones & Messagerie</h3>
                                <div class="mt-2 space-y-1.5">
                                    <a href="tel:+243897230488" class="block text-base font-extrabold text-slate-900 hover:text-halal-600 transition">
                                        +243 897 230 488
                                    </a>
                                    <a href="tel:+243988374715" class="block text-base font-extrabold text-slate-900 hover:text-halal-600 transition">
                                        +243 988 374 715
                                    </a>
                                </div>
                                <div class="flex flex-wrap gap-2 mt-3">
                                    <a href="tel:+243897230488" class="inline-flex items-center gap-1.5 bg-halal-600 hover:bg-halal-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition">
                                        <i class="fa-solid fa-phone"></i> Appeler maintenant
                                    </a>
                                    <a href="https://wa.me/243897230488?text=Bonjour%20Ets.%20HALAL%20SERVICE,%20je%20souhaite%20avoir%20des%20informations." target="_blank" rel="noopener" class="inline-flex items-center gap-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3.5 py-2 rounded-xl transition">
                                        <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp Direct
                                    </a>
                                </div>
                                <p class="text-[11px] text-slate-400 mt-2 italic">
                                    * Ligne WhatsApp principale (+243 897 230 488) sous réserve de confirmation définitive par l'Ets. HALAL SERVICE.
                                </p>
                            </div>
                        </div>

                        <!-- Email & Site Web -->
                        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-soft flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-slate-100 text-slate-800 flex items-center justify-center text-lg flex-shrink-0">
                                <i class="fa-solid fa-globe"></i>
                            </div>
                            <div>
                                <h3 class="font-display font-bold text-slate-900 text-sm">E-mail & Portail Web</h3>
                                <a href="mailto:setshalal@ets.halalservice.com" class="block text-sm font-bold text-halal-600 hover:underline mt-1">
                                    setshalal@ets.halalservice.com
                                </a>
                                <p class="text-xs text-slate-500 mt-0.5">
                                    Domaine officiel : <span class="font-semibold text-slate-700"> <a href="ets-halalservice.com/">www.ets.halalservice.com</a> </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Colonne Formulaire de Contact Interactif (7 colonnes) -->
                <div class="lg:col-span-7 reveal">
                    <div class="bg-white rounded-[2rem] p-7 sm:p-10 shadow-card border border-slate-200/80">
                        <div class="african-kente-bar -mx-7 sm:-mx-10 -mt-7 sm:-mt-10 mb-7 rounded-t-[2rem]"></div>
                        <h3 class="font-display font-extrabold text-2xl text-slate-900 mb-2">
                            Envoyez-nous un message
                        </h3>
                        <p class="text-sm text-slate-500 mb-6">
                            Remplissez ce formulaire, un conseiller de l’Établissement HALAL SERVICE vous recontactera dans les plus brefs délais.
                        </p>

                        <form id="contact-form" class="space-y-5">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="fullname" class="block text-xs font-bold text-slate-700 mb-1.5">Nom complet / Entreprise *</label>
                                    <input type="text" id="fullname" required placeholder="Ex: Grâce Mukendi / Coopérative Espoir" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-ivory-50/50 focus:bg-white focus:border-halal-600 focus:ring-2 focus:ring-halal-600/20 outline-none text-sm transition">
                                </div>
                                <div>
                                    <label for="phone" class="block text-xs font-bold text-slate-700 mb-1.5">Téléphone / WhatsApp *</label>
                                    <input type="tel" id="phone" required placeholder="Ex: +243 812 345 678" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-ivory-50/50 focus:bg-white focus:border-halal-600 focus:ring-2 focus:ring-halal-600/20 outline-none text-sm transition">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label for="email" class="block text-xs font-bold text-slate-700 mb-1.5">Adresse e-mail</label>
                                    <input type="email" id="email" placeholder="votre.email@exemple.com" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-ivory-50/50 focus:bg-white focus:border-halal-600 focus:ring-2 focus:ring-halal-600/20 outline-none text-sm transition">
                                </div>
                                <div>
                                    <label for="service-select" class="block text-xs font-bold text-slate-700 mb-1.5">Domaine concerné *</label>
                                    <select id="service-select" class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-ivory-50/50 focus:bg-white focus:border-halal-600 focus:ring-2 focus:ring-halal-600/20 outline-none text-sm transition">
                                        <option value="Accompagnement & Structuration PME">Accompagnement & Structuration PME</option>
                                        <option value="Business Plan & Stratégie">Business Plan & Plan Stratégique</option>
                                        <option value="Formation & Coaching">Formation & Coaching des dirigeants</option>
                                        <option value="Accès au Financement">Accès au Financement & Partenariats</option>
                                        <option value="Services Immobiliers">Immobilier (Location / Vente terrain)</option>
                                        <option value="Autre demande">Autre demande d'information</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-xs font-bold text-slate-700 mb-1.5">Votre message ou besoin détaillé *</label>
                                <textarea id="message" rows="4" required placeholder="Décrivez brièvement votre projet, vos besoins de formation ou votre recherche immobilière..." class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-ivory-50/50 focus:bg-white focus:border-halal-600 focus:ring-2 focus:ring-halal-600/20 outline-none text-sm transition"></textarea>
                            </div>

                            <button type="submit" class="w-full bg-halal-600 hover:bg-halal-700 text-white font-bold py-4 rounded-xl shadow-glow transition flex items-center justify-center gap-2 text-base">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span>Envoyer ma demande à Ets. HALAL SERVICE</span>
                            </button>

                            <!-- Message de confirmation -->
                            <div id="form-feedback" class="hidden p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-start gap-3">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-lg mt-0.5"></i>
                                <div>
                                    <p class="font-bold">Message transmis avec succès !</p>
                                    <p class="text-xs mt-0.5">Merci d'avoir contacté l’Établissement HALAL SERVICE. Notre secrétariat à Gombe vous répondra rapidement.</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =====================================================================
         10. FOOTER INSTITUTIONNEL & MENTION DE VALIDATION
    ====================================================================== -->
    <?php require_once('layouts/footer.php') ?>

    <!-- =====================================================================
         11. BOUTONS FLOTTANTS D'ACTION RAPIDE (APPEL & WHATSAPP)
    ====================================================================== -->
    <div class="fixed bottom-5 right-5 z-40 flex flex-col gap-3">
        <a href="tel:+243897230488" class="w-13 h-13 p-3.5 rounded-full bg-halal-600 hover:bg-halal-700 text-white shadow-xl flex items-center justify-center transition transform hover:scale-105" title="Appeler Ets. HALAL SERVICE (+243 897 230 488)" aria-label="Appeler Ets. HALAL SERVICE">
            <i class="fa-solid fa-phone text-lg"></i>
        </a>
        <a href="https://wa.me/243897230488?text=Bonjour%20Ets.%20HALAL%20SERVICE,%20je%20souhaite%20avoir%20des%20informations." target="_blank" rel="noopener" class="w-13 h-13 p-3.5 rounded-full bg-emerald-600 hover:bg-emerald-700 text-white shadow-xl flex items-center justify-center transition transform hover:scale-105" title="Contacter sur WhatsApp" aria-label="Contacter sur WhatsApp">
            <i class="fa-brands fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <!-- =====================================================================
         12. MODALE VISIONNEUSE LIGHTBOX (GALERIE PHOTOS)
    ====================================================================== -->
    <div id="lightbox-modal" class="hidden fixed inset-0 z-50 bg-slate-950/85 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeLightbox(event)">
        <div class="bg-white rounded-3xl max-w-3xl w-full overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
            <div class="relative">
                <img id="lightbox-img" src="" alt="" class="w-full max-h-[65vh] object-cover">
                <button onclick="closeLightbox()" class="absolute top-4 right-4 w-10 h-10 rounded-full bg-slate-950/70 hover:bg-slate-950 text-white flex items-center justify-center transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <div class="p-6">
                <h3 id="lightbox-title" class="font-display font-extrabold text-xl text-slate-900"></h3>
                <p id="lightbox-desc" class="text-sm text-slate-600 mt-1.5"></p>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         13. MODALE APERÇU ROLL-UP / PROSPECTUS OFFICIEL
    ====================================================================== -->
    <div id="prospectus-modal" class="hidden fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-sm flex items-center justify-center p-4" onclick="closeProspectusPreview()">
        <div class="bg-white rounded-3xl max-w-xl w-full p-6 sm:p-8 shadow-2xl border border-slate-200 max-h-[90vh] overflow-y-auto" onclick="event.stopPropagation()">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xs font-extrabold uppercase tracking-wider text-halal-600">Roll-Up & Prospectus Officiel</span>
                <button onclick="closeProspectusPreview()" class="text-slate-400 hover:text-slate-700 p-1">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <div class="rounded-2xl border-2 border-halal-600 bg-gradient-to-b from-halal-50 to-white p-6 text-center space-y-4">
                <p class="font-display font-extrabold text-2xl text-halal-700">Ets. HALAL SERVICE</p>
                <p class="inline-block bg-halal-600 text-white text-xs font-bold px-4 py-1.5 rounded-full">
                    La richesse c'est avant tout bien se former
                </p>
                <p class="text-xs text-slate-600">
                    Accompagnement des PME • Diagnostic & Structuration • Business Plans • Formalisation • Formation & Coaching • Financement • Développement Commercial • Suivi Personnalisé • Immobilier
                </p>
                <div class="bg-white rounded-xl p-4 border border-slate-200 text-left text-xs space-y-1.5 text-slate-700">
                    <p><strong>Adresse :</strong> Av. Adama 16, Q. Socimat, C. de la Gombe (Face Brussels Airlines)</p>
                    <p><strong>Tél :</strong> +243 897 230 488 / +243 988 374 715</p>
                    <p><strong>E-mail :</strong> setshalal@ets.halalservice.com</p>
                </div>
            </div>
            <div class="mt-5 flex justify-end gap-3">
                <button onclick="closeProspectusPreview()" class="px-4 py-2.5 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100">Fermer</button>
                <a href="#contact" onclick="closeProspectusPreview(); selectSubject('Demande de réception des prospectus officiels');" class="bg-halal-600 hover:bg-halal-700 text-white px-5 py-2.5 rounded-xl text-xs font-bold">
                    Demander la version imprimable
                </a>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         14. MODALE ESPACE ADMINISTRATION (PUBLICATION D'ACTUS & GALERIE)
    ====================================================================== -->
    <div id="admin-modal" class="hidden fixed inset-0 z-50 bg-slate-950/75 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-lg w-full p-6 sm:p-8 shadow-2xl border border-slate-100 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center gap-2.5">
                    <div class="w-10 h-10 rounded-xl bg-halal-100 text-halal-600 flex items-center justify-center">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div>
                        <h3 class="font-display font-extrabold text-lg text-slate-900 leading-tight">Espace Admin HALAL SERVICE</h3>
                        <p class="text-[11px] text-emerald-600 font-bold flex items-center gap-1">
                            <i class="fa-solid fa-circle-check"></i> Accès remis à Ets. HALAL SERVICE
                        </p>
                    </div>
                </div>
                <button onclick="closeAdminModal()" class="text-slate-400 hover:text-slate-600 p-1">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <p class="text-xs text-slate-500 mb-4">
                Publiez instantanément une nouvelle actualité ou ajoutez une photo dans la galerie du site.
            </p>

            <!-- Onglets -->
            <div class="grid grid-cols-2 gap-2 bg-slate-100 p-1 rounded-xl mb-5">
                <button type="button" id="tab-news-btn" onclick="switchAdminTab('news')" class="py-2 rounded-lg text-xs font-bold bg-white text-halal-700 shadow-sm transition">
                    <i class="fa-solid fa-newspaper mr-1"></i> Nouvelle Actualité
                </button>
                <button type="button" id="tab-photo-btn" onclick="switchAdminTab('photo')" class="py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-slate-900 transition">
                    <i class="fa-solid fa-camera mr-1"></i> Ajouter une Photo
                </button>
            </div>

            <!-- Formulaire Actualité -->
            <form id="admin-news-form" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catégorie</label>
                    <select id="news-category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
                        <option value="Formation PME">Formation PME</option>
                        <option value="Femmes Maraîchères">Femmes Maraîchères</option>
                        <option value="Offre Immobilière">Offre Immobilière</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Titre de l'actualité *</label>
                    <input type="text" id="news-title" required placeholder="Ex: Nouvelle session de coaching entrepreneurial" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Contenu de l'annonce *</label>
                    <textarea id="news-content" rows="3" required placeholder="Rédigez le détail de votre publication..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm"></textarea>
                </div>
                <button type="submit" class="w-full bg-halal-600 hover:bg-halal-700 text-white font-bold py-3 rounded-xl text-sm transition">
                    Publier sur le site
                </button>
            </form>

            <!-- Formulaire Photo -->
            <form id="admin-photo-form" class="hidden space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catégorie de la galerie *</label>
                    <select id="photo-category" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm bg-white">
                        <option value="maraicheres">Femmes maraîchères</option>
                        <option value="formation">Formations & Coaching</option>
                        <option value="immobilier">Immobilier & Projets</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Titre / Légende de la photo *</label>
                    <input type="text" id="photo-title" required placeholder="Ex: Visite terrain des coopératives maraîchères" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">URL de l'image (optionnel)</label>
                    <input type="url" id="photo-url" placeholder="https://... (laisser vide pour visuel par défaut)" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 text-sm">
                </div>
                <button type="submit" class="w-full bg-earth-600 hover:bg-earth-700 text-white font-bold py-3 rounded-xl text-sm transition">
                    Ajouter à la galerie
                </button>
            </form>
        </div>
    </div>

    <!-- =====================================================================
         15. SCRIPTS INTERACTIFS & ANIMATIONS
    ====================================================================== -->
    <script>
        // 1. Animations d'apparition fluides au défilement
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                    }
                });
            }, { threshold: 0.1 });

            reveals.forEach(el => observer.observe(el));
        });

        // 2. Menu Mobile
        const mobileBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
        document.querySelectorAll('.mobile-link').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });

        // 3. Filtres de la Galerie Photos
        const filterBtns = document.querySelectorAll('.gallery-filter');
        let currentFilter = 'all';

        function applyGalleryFilter(filter) {
            currentFilter = filter;
            document.querySelectorAll('.gallery-item').forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });
        }

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => {
                    b.classList.remove('bg-halal-600', 'text-white', 'shadow-sm');
                    b.classList.add('bg-white', 'text-slate-700');
                });
                btn.classList.remove('bg-white', 'text-slate-700');
                btn.classList.add('bg-halal-600', 'text-white', 'shadow-sm');
                applyGalleryFilter(btn.getAttribute('data-filter'));
            });
        });

        // 4. Lightbox Galerie Photos
        function openLightbox(card) {
            const img = card.querySelector('img').src;
            const title = card.getAttribute('data-title') || '';
            const desc = card.getAttribute('data-desc') || '';
            document.getElementById('lightbox-img').src = img;
            document.getElementById('lightbox-title').textContent = title;
            document.getElementById('lightbox-desc').textContent = desc;
            document.getElementById('lightbox-modal').classList.remove('hidden');
        }

        function closeLightbox() {
            document.getElementById('lightbox-modal').classList.add('hidden');
        }

        // 5. Modale Aperçu Roll-Up / Prospectus
        function openProspectusPreview() {
            document.getElementById('prospectus-modal').classList.remove('hidden');
        }
        function closeProspectusPreview() {
            document.getElementById('prospectus-modal').classList.add('hidden');
        }

        // 6. Pré-remplissage du formulaire de contact
        function selectSubject(subject) {
            const messageArea = document.getElementById('message');
            messageArea.value = `Bonjour Ets. HALAL SERVICE, je souhaite obtenir plus d'informations concernant : ${subject}. Merci de me recontacter.`;
        }

        // 7. Soumission Formulaire de Contact
        const contactForm = document.getElementById('contact-form');
        const formFeedback = document.getElementById('form-feedback');
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            formFeedback.classList.remove('hidden');
            contactForm.reset();
            setTimeout(() => formFeedback.classList.add('hidden'), 7000);
        });

        // 8. Espace Administration (Publication Actus & Ajout Photos)
        const adminModal = document.getElementById('admin-modal');
        const adminNewsForm = document.getElementById('admin-news-form');
        const adminPhotoForm = document.getElementById('admin-photo-form');

        function openAdminModal() { adminModal.classList.remove('hidden'); }
        function closeAdminModal() { adminModal.classList.add('hidden'); }

        function switchAdminTab(tab) {
            const newsBtn = document.getElementById('tab-news-btn');
            const photoBtn = document.getElementById('tab-photo-btn');
            if (tab === 'news') {
                adminNewsForm.classList.remove('hidden');
                adminPhotoForm.classList.add('hidden');
                newsBtn.className = 'py-2 rounded-lg text-xs font-bold bg-white text-halal-700 shadow-sm transition';
                photoBtn.className = 'py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-slate-900 transition';
            } else {
                adminPhotoForm.classList.remove('hidden');
                adminNewsForm.classList.add('hidden');
                photoBtn.className = 'py-2 rounded-lg text-xs font-bold bg-white text-halal-700 shadow-sm transition';
                newsBtn.className = 'py-2 rounded-lg text-xs font-bold text-slate-600 hover:text-slate-900 transition';
            }
        }

        adminNewsForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const category = document.getElementById('news-category').value;
            const title = document.getElementById('news-title').value;
            const content = document.getElementById('news-content').value;

            const article = document.createElement('article');
            article.className = 'rounded-2xl border-2 border-halal-500 bg-halal-50/60 p-6 flex flex-col justify-between';
            article.innerHTML = `
                <div>
                    <div class="flex items-center justify-between text-xs text-halal-700 font-semibold mb-3">
                        <span><i class="fa-regular fa-calendar mr-1"></i> Publié à l'instant</span>
                        <span class="bg-earth-400 text-slate-950 px-2.5 py-0.5 rounded-full text-[11px] font-extrabold">Nouveau</span>
                    </div>
                    <h4 class="font-display font-bold text-lg text-slate-900 mb-2">${title}</h4>
                    <p class="text-sm text-slate-600 leading-relaxed">${content}</p>
                </div>
                <span class="mt-5 inline-flex items-center gap-1.5 text-xs font-extrabold text-halal-700">${category}</span>
            `;
            document.getElementById('news-container').prepend(article);
            adminNewsForm.reset();
            closeAdminModal();
        });

        adminPhotoForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const category = document.getElementById('photo-category').value;
            const title = document.getElementById('photo-title').value;
            const customUrl = document.getElementById('photo-url').value.trim();

            const fallbacks = {
                maraicheres: 'https://images.pexels.com/photos/6646918/pexels-photo-6646918.jpeg?auto=compress&cs=tinysrgb&w=1000',
                formation: 'https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?auto=format&fit=crop&w=900&q=85',
                immobilier: 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=900&q=85'
            };

            const labels = {
                maraicheres: 'Femmes Maraîchères',
                formation: 'Formations & Coaching',
                immobilier: 'Immobilier & Projets'
            };

            const imgSrc = customUrl || fallbacks[category];
            const card = document.createElement('div');
            card.className = 'gallery-item cursor-pointer group relative rounded-3xl overflow-hidden shadow-soft bg-white aspect-[4/3] border-4 border-earth-400';
            card.setAttribute('data-category', category);
            card.setAttribute('data-title', title);
            card.setAttribute('data-desc', 'Publication ajoutée depuis l’espace d’administration Ets. HALAL SERVICE.');
            card.setAttribute('onclick', 'openLightbox(this)');
            card.innerHTML = `
                <img src="${imgSrc}" onerror="this.onerror=null;this.src='https://placehold.co/800x600/0072BC/ffffff?text=Ets.+HALAL+SERVICE';" alt="${title}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                <div class="absolute top-3 right-3 bg-earth-500 text-slate-950 text-[10px] font-extrabold px-2.5 py-0.5 rounded-full uppercase">Nouveau</div>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-slate-900/20 to-transparent flex flex-col justify-end p-6 text-white">
                    <span class="text-[11px] font-extrabold text-earth-400 uppercase tracking-wider">${labels[category]}</span>
                    <h4 class="font-display font-bold text-lg mt-0.5">${title}</h4>
                </div>
            `;
            const galleryTarget = document.getElementById('gallery-grid');
            if (galleryTarget) {
                galleryTarget.prepend(card);
                if (typeof applyGalleryFilter === 'function') applyGalleryFilter(currentFilter);
            } else {
                alert('Pour publier durablement une photo, ajoutez le fichier dans le dossier qui gère les phtotos.');
            }
            adminPhotoForm.reset();
            closeAdminModal();
        });

        // Slider horizontal des réalisations (page d'accueil)
        (() => {
            const track = document.getElementById('gallery-slider');
            const prev = document.getElementById('gallery-prev');
            const next = document.getElementById('gallery-next');
            if (!track) return;

            const distance = () => {
                const first = track.querySelector('.gallery-slide');
                return first ? first.getBoundingClientRect().width + 20 : track.clientWidth;
            };

            prev?.addEventListener('click', () => {
                track.scrollBy({ left: -distance(), behavior: 'smooth' });
            });
            next?.addEventListener('click', () => {
                const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 5;
                track.scrollTo({ left: atEnd ? 0 : track.scrollLeft + distance(), behavior: 'smooth' });
            });

            // Défilement automatique, suspendu lorsque le visiteur survole la galerie.
            let autoSlide = setInterval(() => {
                if (track.matches(':hover')) return;
                const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 5;
                track.scrollTo({ left: atEnd ? 0 : track.scrollLeft + distance(), behavior: 'smooth' });
            }, 4500);

            track.addEventListener('touchstart', () => clearInterval(autoSlide), { passive: true, once: true });
        })();
    </script>
</body>
</html>