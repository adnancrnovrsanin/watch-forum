<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px] m-2">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Create a poll for your topic
        </h1>
        <form action="{{ route('topic.polls.store', $topic) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-label for="question" :required="true">What do you want to ask?</x-label>
                <x-text-input name="question" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="answers" :required="true">Possible Answers</x-label>
                <div id="answers-container">
                    <div class="flex items-center mb-4">
                        <x-text-input name="answers[]" class="w-full" />
                        <button type="button" class="ml-2 text-red-500" onclick="removeAnswer(this)">Remove</button>
                    </div>
                </div>
                <button type="button" class="mt-2 text-blue-500" onclick="addAnswer()">Add Answer</button>
            </div>

            <script>
                function addAnswer() {
                    const container = document.getElementById('answers-container');
                    const answerInput = document.createElement('div');
                    answerInput.classList.add('flex', 'items-center', 'mb-4');
                    answerInput.innerHTML = `
                        <x-text-input name="answers[]" class="w-full" />
                        <button type="button" class="ml-2 text-red-500" onclick="removeAnswer(this)">Remove</button>
                    `;
                    container.appendChild(answerInput);
                }

                function removeAnswer(button) {
                    const answerInput = button.parentNode;
                    answerInput.remove();
                }
            </script>

            <x-button class="w-full font-medium">Create a poll</x-button>
        </form>
    </x-card>
</x-layout>