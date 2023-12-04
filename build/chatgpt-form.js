document.addEventListener('DOMContentLoaded', function () {
    // Check if required elements exist
    const submitButton = document.getElementById('submit_question');
    const responseDiv = document.getElementById('chatgpt_response');
    const questionInput = document.getElementById('user_question');

    if (!submitButton || !responseDiv || !questionInput) {
        console.error('Required elements not found. Make sure your HTML structure is correct.');
        return;
    }

    submitButton.addEventListener('click', function () {
        const userQuestion = questionInput.value;

        // Validate user input
        if (!userQuestion) {
            alert('Please enter a question before submitting.');
            return;
        }

        // Make a request to the ChatGPT API
        fetch(chatgpt_form_data.api_url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + chatgpt_form_data.api_key,
            },
            body: JSON.stringify({
                model: chatgpt_form_data.model,
                messages: [
                    { role: 'system', content: 'You are a helpful assistant.' },
                    { role: 'user', content: userQuestion },
                ],
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Display the response in the response div
            responseDiv.innerHTML = 'Respuesta de ChatGPT: ' + data.choices[0].message.content;
            responseDiv.classList.add('chatgpt-response'); // Agregar clase CSS
        })
        .catch(error => {
            console.error('Error al realizar la solicitud a la API de ChatGPT:', error);
            responseDiv.innerHTML = 'Hubo un error al procesar la pregunta.';
            responseDiv.classList.add('error-response'); // Agregar clase CSS
        });
    });
});



