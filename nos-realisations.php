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

    $extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
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
    <title>Nos Réalisations & Actualités | Ets. HALAL SERVICE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], display: ['Plus Jakarta Sans', 'sans-serif'] },
                    colors: {
                        halal: { 50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 500: '#0284c7', 600: '#0072BC', 700: '#0369a1', 800: '#075985' },
                        ivory: { 50: '#FAF8F5', 100: '#F4F0EA' },
                        earth: { 50: '#fffbeb', 100: '#fef3c7', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309' }
                    }
                }
            }
        }
    </script>
    <style>
        .african-kente-bar { height: 5px; background: repeating-linear-gradient(90deg, #0072BC 0px, #0072BC 28px, #D97706 28px, #D97706 42px, #0F172A 42px, #0F172A 50px, #F59E0B 50px, #F59E0B 64px); }
        .african-pattern-bg { background-color: #FAF8F5; background-image: radial-gradient(#0072BC14 1.25px, transparent 1.25px), radial-gradient(#D9770614 1.25px, #FAF8F5 1.25px); background-size: 36px 36px; background-position: 0 0, 18px 18px; }
        
        /* Styles pour les animations au défilement (Scroll Reveal) */
        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            will-change: opacity, transform;
        }
        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-ivory-50 text-slate-800 antialiased">

     <?php require_once('layouts/navbar.php');?>

    <section class="african-pattern-bg py-14 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div class="reveal-on-scroll">
                <nav class="text-xs font-semibold text-slate-500 mb-3">
                    <a href="index.php" class="hover:text-halal-600">Accueil</a> <span class="mx-2">/</span> <span class="text-halal-700">Nos réalisations & Actualités</span>
                </nav>
                <h1 class="font-display font-extrabold text-3xl sm:text-5xl text-slate-900">Réalisations, Galerie & Actualités</h1>
            </div> 
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-sm text-slate-600 mb-8 reveal-on-scroll">Découvrez en images quelques activités et projets de Ets. HALAL SERVICE. Les photos sont chargées automatiquement depuis notre galerie.</p>

            <!-- Galerie alimentée automatiquement par assets/images/galerie/ -->
            <?php if (!empty($imagesGalerie)): ?>
                <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($imagesGalerie as $index => $image): ?>
                        <?php
                            $nomFichier = pathinfo(rawurldecode($image), PATHINFO_FILENAME);
                            $titre = ucwords(str_replace(['-', '_'], ' ', $nomFichier));
                            if ($titre === '') $titre = 'Réalisation ' . ($index + 1);
                            $libelle = 'Réalisations & activités';
                        ?>
                        <article class="gallery-item group relative rounded-3xl overflow-hidden shadow bg-white aspect-[4/3] border-4 border-white cursor-pointer reveal-on-scroll"
                                 data-category="all"
                                 onclick="openImageModal(<?= $index ?>)">
                            <img src="<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>"
                                 alt="<?= htmlspecialchars($titre, ENT_QUOTES, 'UTF-8') ?>"
                                 loading="lazy"
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/85 via-transparent to-transparent flex flex-col justify-end p-6 text-white pointer-events-none">
                                <span class="text-[11px] font-extrabold text-earth-400 uppercase"><?= htmlspecialchars($libelle, ENT_QUOTES, 'UTF-8') ?></span>
                                <h3 class="font-display font-bold text-lg">Ets. HALAL SERVICE</h3>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-10 text-center text-slate-500 reveal-on-scroll">
                    <i class="fa-regular fa-images text-4xl text-halal-600 mb-3"></i>
                    <p class="font-bold text-slate-700">La galerie est momentanément vide.</p>
                    <p class="text-sm mt-2">Déposez vos photos dans le dossier <code>assets/images/galerie/</code> pour les afficher automatiquement ici.</p>
                </div>
            <?php endif; ?>

            <!-- Actualités -->
            <div class="mt-16 bg-white rounded-3xl p-8 border border-slate-200 reveal-on-scroll">
                <h2 class="font-display font-extrabold text-2xl text-slate-900 mb-6">Actualités de l’Ets. HALAL SERVICE</h2>
                <div id="news-container" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <article class="rounded-2xl border p-6 bg-ivory-50">
                        <span class="text-xs font-bold text-halal-600">Formation PME • 2026</span>
                        <h3 class="font-display font-bold text-lg mt-2">Lancement des sessions de renforcement des capacités</h3>
                        <p class="text-sm text-slate-600 mt-2">Inscriptions ouvertes à notre siège de Gombe pour les modules en gestion financière et stratégie.</p>
                    </article>
                    <article class="rounded-2xl border p-6 bg-ivory-50">
                        <span class="text-xs font-bold text-earth-600">Femmes Maraîchères</span>
                        <h3 class="font-display font-bold text-lg mt-2">Accompagnement des groupements maraîchers</h3>
                        <p class="text-sm text-slate-600 mt-2">Structuration en coopératives et accès aux partenaires commerciaux à Kinshasa.</p>
                    </article>
                    <article class="rounded-2xl border p-6 bg-ivory-50">
                        <span class="text-xs font-bold text-slate-700">Pôle Immobilier</span>
                        <h3 class="font-display font-bold text-lg mt-2">Nouvelles offres de location et terrains</h3>
                        <p class="text-sm text-slate-600 mt-2">Découvrez nos biens disponibles immédiatement via Ets. HALAL SERVICE.</p>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <!-- MODALE APERÇU IMAGE AVEC PRECEDENT / SUIVANT -->
    <div id="image-modal" class="hidden fixed inset-0 z-50 bg-slate-950/85 flex items-center justify-center p-4">
        <div class="relative max-w-4xl w-full bg-slate-900 rounded-3xl overflow-hidden shadow-2xl border border-slate-800">
            <!-- Bouton Fermer -->
            <button onclick="closeImageModal()" class="absolute top-4 right-4 z-20 bg-slate-800/80 hover:bg-slate-700 text-white w-10 h-10 rounded-full flex items-center justify-center transition">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <!-- Bouton Précédent -->
            <button onclick="prevImage()" class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-slate-800/80 hover:bg-slate-700 text-white w-12 h-12 rounded-full flex items-center justify-center transition shadow-lg">
                <i class="fa-solid fa-chevron-left text-lg"></i>
            </button>

            <!-- Bouton Suivant -->
            <button onclick="nextImage()" class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-slate-800/80 hover:bg-slate-700 text-white w-12 h-12 rounded-full flex items-center justify-center transition shadow-lg">
                <i class="fa-solid fa-chevron-right text-lg"></i>
            </button>

            <div class="p-2 sm:p-8 flex items-center justify-center max-h-[80vh]">
                <img id="modal-img" src="" alt="" class="max-h-[72vh] max-w-full object-contain rounded-2xl">
            </div>
            <div id="modal-caption" class="px-16 py-4 bg-slate-950 text-white font-display font-bold text-center text-sm border-t border-slate-800 truncate"></div>
        </div>
    </div>

    <?php require_once('layouts/footer.php'); ?>

    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', () => document.getElementById('mobile-menu').classList.toggle('hidden'));
        
        // Données des images pour le carrousel de la modale
        const galleryData = [
            <?php foreach ($imagesGalerie as $index => $image): 
                $nomFichier = pathinfo(rawurldecode($image), PATHINFO_FILENAME);
                $titre = ucwords(str_replace(['-', '_'], ' ', $nomFichier));
                if ($titre === '') $titre = 'Réalisation ' . ($index + 1);
            ?>
            { src: "<?= htmlspecialchars($image, ENT_QUOTES, 'UTF-8') ?>", title: "<?= htmlspecialchars($titre, ENT_QUOTES, 'UTF-8') ?>" },
            <?php endforeach; ?>
        ];

        let currentIndex = 0;

        function openImageModal(index) {
            currentIndex = index;
            updateModalContent();
            document.getElementById('image-modal').classList.remove('hidden');
        }

        function closeImageModal() {
            document.getElementById('image-modal').classList.add('hidden');
        }

        function nextImage() {
            if (galleryData.length === 0) return;
            currentIndex = (currentIndex + 1) % galleryData.length;
            updateModalContent();
        }

        function prevImage() {
            if (galleryData.length === 0) return;
            currentIndex = (currentIndex - 1 + galleryData.length) % galleryData.length;
            updateModalContent();
        }

        function updateModalContent() {
            if (galleryData.length === 0) return;
            const item = galleryData[currentIndex];
            document.getElementById('modal-img').src = item.src;
            document.getElementById('modal-img').alt = item.title;
            document.getElementById('modal-caption').textContent = item.title;
        }

        // Navigation au clavier (Flèche gauche, flèche droite, Échap)
        document.addEventListener('keydown', (e) => {
            const modal = document.getElementById('image-modal');
            if (modal.classList.contains('hidden')) return;

            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'Escape') closeImageModal();
        });

        // Fermer la modale en cliquant en dehors de l'image
        document.getElementById('image-modal').addEventListener('click', (e) => {
            if (e.target.id === 'image-modal') {
                closeImageModal();
            }
        });

        // Script d'observation pour déclencher les animations au défilement (Scroll Reveal)
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target); // Animation jouée une seule fois par élément
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });

        document.getElementById('admin-news-form').addEventListener('submit', (e) => {
            e.preventDefault();
            const article = document.createElement('article');
            article.className = 'rounded-2xl border-2 border-halal-500 p-6 bg-halal-50';
            article.innerHTML = `<span class="text-xs font-bold text-halal-700">Nouveau</span><h3 class="font-display font-bold text-lg mt-2">${document.getElementById('news-title').value}</h3><p class="text-sm text-slate-600 mt-2">${document.getElementById('news-content').value}</p>`;
            document.getElementById('news-container').prepend(article);
            e.target.reset();
            document.getElementById('admin-modal').classList.add('hidden');
        });
    </script>
</body>
</html>