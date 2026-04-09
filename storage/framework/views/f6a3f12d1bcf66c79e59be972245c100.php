<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Highlight.js for Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/marked/11.1.1/marked.min.js"></script>

     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-xl text-green-400 leading-tight font-mono flex items-center gap-2">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
            <?php echo e($quiz->title); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-slate-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-2xl sm:rounded-lg border border-gray-700">
                <div class="p-6 text-gray-300">
                    <p class="mb-6 text-green-500 font-mono text-sm uppercase tracking-widest border-b border-gray-700 pb-4">> <?php echo e($quiz->description); ?></p>

                    <form action="<?php echo e(route('quizzes.submit', $quiz->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <?php $__currentLoopData = $quiz->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-10 bg-slate-900 rounded-lg overflow-hidden border border-gray-700 shadow-md">
                                <!-- The Code Block Header -->
                                <div class="bg-slate-800 px-4 py-2 border-b border-gray-700 flex items-center justify-between">
                                    <span class="font-mono text-xs text-red-400">🚨 BUG DETECTED #<?php echo e($index + 1); ?></span>
                                    <div class="flex gap-1.5">
                                        <div class="w-3 h-3 rounded-full bg-red-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                                    </div>
                                </div>
                                
                                <!-- The Buggy Code Content -->
                                <div class="p-4 overflow-x-auto text-sm markdown-content" data-markdown="<?php echo e(base64_encode($question->question_text)); ?>">
                                    <!-- Populated by JS -->
                                    <div class="animate-pulse flex space-x-4">
                                      <div class="h-4 bg-slate-700 rounded w-3/4"></div>
                                    </div>
                                </div>
                                
                                <!-- The Fixes (Answers) -->
                                <div class="bg-gray-850 p-4 border-t border-gray-700">
                                    <p class="font-mono text-sm text-green-400 mb-4">> SÉLECTIONNEZ LE PATCH :</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <?php $__currentLoopData = $question->answers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <label class="flex items-start space-x-3 cursor-pointer p-3 rounded border border-gray-700 hover:border-green-500 hover:bg-slate-800 transition group has-[:checked]:border-green-500 has-[:checked]:bg-green-900/20">
                                                <input type="radio" name="answers[<?php echo e($question->id); ?>]" value="<?php echo e($answer->id); ?>" class="mt-1 border-gray-500 bg-slate-900 text-green-500 focus:ring-green-500 focus:ring-offset-slate-900" required>
                                                <span class="font-mono text-sm text-gray-300 group-hover:text-green-300"><?php echo e($answer->answer_text); ?></span>
                                            </label>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="flex justify-end mt-8 border-t border-gray-700 pt-6">
                            <button type="submit" class="px-8 py-3 bg-red-600 text-white font-mono font-bold uppercase tracking-widest rounded transition flex items-center gap-2 hover:bg-red-500 shadow-[0_0_15px_rgba(220,38,38,0.4)]">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Déployer les Patches
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Script to render Markdown exactly as returned by LLM -->
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const containers = document.querySelectorAll('.markdown-content');
            containers.forEach(container => {
                const b64 = container.getAttribute('data-markdown');
                const mdText = decodeURIComponent(escape(window.atob(b64)));
                container.innerHTML = marked.parse(mdText);
            });
            // Highlight code blocks
            document.querySelectorAll('pre code').forEach((el) => {
                hljs.highlightElement(el);
            });
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\mat95\OneDrive\Bureau\ProjetEcole\quiz-ai-education\resources\views/quizzes/show.blade.php ENDPATH**/ ?>