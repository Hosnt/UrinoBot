document.getElementById('openChatbot').addEventListener('click', function() {
    document.getElementById('chatPopup').style.display = 'flex';
});

function closeChatPopup() {
    document.getElementById('chatPopup').style.display = 'none';
}

// Handle Image Upload and API Call
document.querySelector("form").addEventListener("submit", async function (event) {
    event.preventDefault();
    
    const fileInput = document.getElementById("fileInput");
    if (!fileInput.files.length) {
        alert("Please select an image.");
        return;
    }

    const formData = new FormData();
    formData.append("image", fileInput.files[0]);

    try {
        const response = await fetch("process_image.php", {
            method: "POST",
            body: formData
        });

        const data = await response.json();
        if (data.success) {
            document.querySelector(".output").textContent = "Generated Code:\n" + data.code;
        } else {
            alert("Error processing image: " + data.error);
        }
    } catch (error) {
        console.error("Error:", error);
        alert("Failed to upload image.");
    }
});
