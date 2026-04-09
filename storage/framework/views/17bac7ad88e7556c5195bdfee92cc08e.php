<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quiz AI - La Révolution de vos Révisions</title>
    <meta name="description" content="Générateur de quiz IA pour les étudiants. Transformez vos cours en QCM interactifs en quelques secondes.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php else: ?>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Inter', 'sans-serif'],
                        },
                        colors: {
                            primary: {
                                50: '#eef2ff',
                                100: '#e0e7ff',
                                500: '#6366f1',
                                600: '#4f46e5',
                                700: '#4338ca',
                                900: '#312e81',
                            }
                        }
                    }
                }
            }
        </script>
    <?php endif; ?>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glassb {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 glassb transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        Q
                    </div>
                    <span class="font-bold text-xl tracking-tight text-slate-900">Quiz<span class="text-primary-600">AI</span></span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#probleme" class="text-slate-600 hover:text-primary-600 font-medium transition-colors">Notre Solution</a>
                    <a href="#usages" class="text-slate-600 hover:text-primary-600 font-medium transition-colors">Comment ça marche</a>
                    <a href="#benefices" class="text-slate-600 hover:text-primary-600 font-medium transition-colors">Avantages</a>
                    
                    <?php if(Route::has('login')): ?>
                        <div class="flex items-center gap-4 ml-4 pl-4 border-l border-slate-200">
                            <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('quizzes.index')); ?>" class="font-medium text-slate-700 hover:text-primary-600 transition-colors">Mon Espace</a>
                                <a href="<?php echo e(route('quizzes.generate')); ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-full font-medium transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    Créer un Quiz
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="font-medium text-slate-700 hover:text-primary-600 transition-colors">Connexion</a>
                                <?php if(Route::has('register')): ?>
                                    <a href="<?php echo e(route('register')); ?>" class="bg-primary-600 hover:bg-primary-700 text-white px-5 py-2.5 rounded-full font-medium transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                        S'inscrire
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header / Accroche -->
    <header class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-50 text-primary-700 font-medium text-sm mb-8 ring-1 ring-inset ring-primary-500/20">
                <span class="flex h-2 w-2 relative">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-primary-500"></span>
                </span>
                Spécialement conçu pour les étudiants
            </div>
            
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold tracking-tight text-slate-900 mb-8 leading-tight">
                Générez vos révisions <br class="hidden md:block" />
                <span class="gradient-text">en quelques secondes</span>
            </h1>
            
            <p class="mt-4 text-xl text-slate-600 max-w-2xl mx-auto font-light leading-relaxed mb-10">
                Ne perdez plus des heures à créer vos fiches. Copiez vos cours, notre Intelligence Artificielle génère instantanément des QCM interactifs pour une mémorisation active et efficace.
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-base font-bold text-white bg-primary-600 hover:bg-primary-700 rounded-full shadow-lg hover:shadow-primary-500/30 transition-all transform hover:-translate-y-1">
                    Commencer gratuitement
                    <svg class="ml-2 w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
                <a href="#usages" class="inline-flex items-center justify-center px-8 py-4 text-base font-medium text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 rounded-full shadow-sm transition-all hover:border-slate-300">
                    Découvrir le fonctionnement
                </a>
            </div>
        </div>
    </header>

    <!-- Problème et Cible -->
    <section id="probleme" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="order-2 lg:order-1">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl ring-1 ring-slate-200/50">
                        <div class="absolute inset-0 bg-gradient-to-tr from-slate-800 to-slate-900 opacity-90"></div>
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Étudiant révisant ses cours" class="w-full h-[500px] object-cover mix-blend-overlay" />
                        <div class="absolute inset-0 p-8 flex flex-col justify-end">
                            <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                                <p class="text-white text-lg font-medium">"J'ai gagné plus de 5h de préparation par semaine et mes notes ont augmenté grâce à la méthode des QCM."</p>
                                <div class="mt-4 flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-slate-400"></div>
                                    <div>
                                        <p class="text-white font-bold text-sm">Marie D.</p>
                                        <p class="text-slate-300 text-xs">Étudiante en Droit</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <h2 class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-3">Le Problème</h2>
                    <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Réviser manque cruellement d'interactivité.</h3>
                    <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                        En tant qu'étudiant, vous savez que relire un cours en boucle (lecture passive) est la méthode la moins efficace pour retenir l'information sur le long terme. 
                        <strong>La mémorisation active par le test</strong> a prouvé son efficacité, mais créer ces tests soi-même prend un temps fou.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-1">Perte de temps</h4>
                                <p class="text-slate-600">Passer des heures à formuler des questions au lieu d'apprendre véritablement.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-green-100 text-green-600 flex items-center justify-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-slate-900 mb-1">Notre Proposition de valeur</h4>
                                <p class="text-slate-600">Laissez notre IA analyser le contexte de vos cours et générer des QCM sur-mesure pour vous tester immédiatement.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Usages / Comment ça marche -->
    <section id="usages" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-primary-600 font-semibold tracking-wide uppercase text-sm mb-3">Fonctionnement</h2>
            <h3 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Aussi simple que 1, 2, 3...</h3>
            <p class="text-xl text-slate-600 mb-16 max-w-2xl mx-auto">Voici comment fonctionne QuizAI pour transformer votre manière d'appréhender vos examens.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Etape 1 -->
                <div class="relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 text-left overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-9xl font-black text-slate-50 group-hover:text-primary-50 transition-colors z-0">1</div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-primary-100 text-primary-600 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Fournissez le cours</h4>
                        <p class="text-slate-600 leading-relaxed">Que ce soit un chapitre d'histoire, un concept de biologie ou du droit, collez simplement votre texte dans notre interface.</p>
                    </div>
                </div>
                
                <!-- Etape 2 -->
                <div class="relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 text-left overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-9xl font-black text-slate-50 group-hover:text-pink-50 transition-colors z-0">2</div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-pink-100 text-pink-600 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">L'IA génère le Quiz</h4>
                        <p class="text-slate-600 leading-relaxed">Notre moteur d'intelligence artificielle extrait les concepts clés, crée des questions pertinentes et de multiples choix de réponses.</p>
                    </div>
                </div>
                
                <!-- Etape 3 -->
                <div class="relative bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-shadow border border-slate-100 text-left overflow-hidden group">
                    <div class="absolute -right-4 -top-4 text-9xl font-black text-slate-50 group-hover:text-green-50 transition-colors z-0">3</div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 rounded-xl bg-green-100 text-green-600 flex items-center justify-center mb-6">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h4 class="text-2xl font-bold text-slate-900 mb-3">Testez vos connaissances</h4>
                        <p class="text-slate-600 leading-relaxed">Passez le quiz immédiatement en ligne. Visualisez votre score et repérez vos lacunes pour un apprentissage optimisé.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefices -->
    <section id="benefices" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Pourquoi les étudiants l'adorent ?</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Ben 1 -->
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-primary-50 text-primary-600 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Gain de Temps</h4>
                    <p class="text-slate-600">Passez 100% de votre temps à apprendre plutôt qu'à préparer des supports.</p>
                </div>
                
                <!-- Ben 2 -->
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-pink-50 text-pink-600 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Qualité IA</h4>
                    <p class="text-slate-600">Des QCM avec pièges, distracteurs pertinents et un réel niveau de chalenge.</p>
                </div>
                
                <!-- Ben 3 -->
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Résultats Boostés</h4>
                    <p class="text-slate-600">L'approche test-and-learn augmente la rétention de 50% selon les études.</p>
                </div>
                
                <!-- Ben 4 -->
                <div class="text-center">
                    <div class="mx-auto w-16 h-16 rounded-full bg-cyan-50 text-cyan-600 flex items-center justify-center mb-6">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 mb-2">Mobile Friendly</h4>
                    <p class="text-slate-600">Révisez vos quiz générés dans les transports depuis n'importe quel appareil.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacter / Access / Foot CTA -->
    <section class="py-20 relative overflow-hidden bg-slate-900 text-white">
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute w-full h-full bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-primary-700 via-slate-900 to-slate-900"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-6">Prêt à valider votre semestre ?</h2>
            <p class="text-xl text-slate-300 mb-10 font-light">Rejoignez de nombreux étudiants qui optimisent déjà leur temps d'apprentissage avec QuizAI.</p>
            <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold text-slate-900 bg-white hover:bg-slate-100 rounded-full shadow-xl hover:shadow-2xl hover:scale-105 transition-all">
                Créer mon compte étudiant maintenant
                <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 py-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-2">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-500 to-pink-500 flex items-center justify-center text-white font-bold text-lg">Q</div>
                    <span class="font-bold text-xl text-white">Quiz<span class="text-primary-500">AI</span></span>
                </div>
                <p class="text-slate-400 text-sm">Design avec 💖 pour la réussite étudiante.</p>
            </div>
            
            <div class="flex space-x-6 text-sm text-slate-400">
                <a href="#" class="hover:text-white transition-colors">Mentions Légales</a>
                <a href="#" class="hover:text-white transition-colors">Contact</a>
                <a href="#" class="hover:text-white transition-colors">CGU</a>
            </div>
        </div>
    </footer>

</body>
</html>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/welcome.blade.php ENDPATH**/ ?>