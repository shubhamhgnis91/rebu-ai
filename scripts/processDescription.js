function processDescription() {
    const desc = document.getElementById("inputDesc").value;
    fetchEnhancedDescription(desc);
}

function fetchEnhancedDescription(description) {
    const formData = new FormData();
    formData.append('prompt', description);

    fetch('../pages/enhance_work.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        displayWithTypingEffect(data);
    })
    .catch(error => console.error('Error:', error));
}

function displayWithTypingEffect(text) {
    const enhancedDescTextArea = document.getElementById("enhancedDesc");
    enhancedDescTextArea.value = ''; // Clear the textarea before typing

    const typingSpeed = 25; // Adjust typing speed (lower value means faster typing)
    let i = 0;
    const typingInterval = setInterval(() => {
        if (i < text.length) {
            enhancedDescTextArea.value += text.charAt(i);
            i++;
        } else {
            clearInterval(typingInterval); // Stop the interval when the typing is done
        }
    }, typingSpeed);
}