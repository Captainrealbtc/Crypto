document.addEventListener('DOMContentLoaded', function() {
    // Fetch market data
    fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum,tron,litecoin&vs_currencies=usd')
        .then(response => response.json())
        .then(data => {
            const pricesDiv = document.getElementById('crypto-prices');
            pricesDiv.innerHTML = `
                <p><strong>Bitcoin (BTC):</strong> $${data.bitcoin.usd}</p>
                <p><strong>Ethereum (ETH):</strong> $${data.ethereum.usd}</p>
                <p><strong>Tron (TRX):</strong> $${data.tron.usd}</p>
                <p><strong>Litecoin (LTC):</strong> $${data.litecoin.usd}</p>
            `;
        })
        .catch(error => console.error('Error fetching market data:', error));

    // Testimonial Carousel Script
    const testimonials = document.querySelectorAll('.testimonial-item');
    let currentIndex = 0;

    function showTestimonial(index) {
        testimonials.forEach((testimonial, i) => {
            testimonial.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextTestimonial() {
        currentIndex = (currentIndex + 1) % testimonials.length;
        showTestimonial(currentIndex);
    }

    // Initialize the first testimonial
    showTestimonial(currentIndex);

    // Change testimonial every 3 seconds
    setInterval(nextTestimonial, 3000);

    // Deposit and Withdrawal Messages Script
    const messages = document.querySelectorAll('.deposit-withdrawal-messages .message');
    let messageIndex = 0;

    function showMessage(index) {
        messages.forEach((message, i) => {
            message.style.display = i === index ? 'block' : 'none';
        });
    }

    function nextMessage() {
        messageIndex = (messageIndex + 1) % messages.length;
        showMessage(messageIndex);
    }

    // Initialize the first message
    showMessage(messageIndex);

    // Change message every 4 seconds
    setInterval(nextMessage, 4000);
});
function validateForm() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    // Show loader
    document.querySelector('.loader').style.display = 'block';
    

    // Simulate form submission and show success modal
    setTimeout(function() {
        document.querySelector('.loader').style.display = 'none';
        showModal();
    }, 2000); // Simulate a 2-second delay for form submission

    return false; // Prevent actual form submission for demonstration purposes
}

function showModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("successModal");
    modal.style.display = "none";
}

function showLoader() {
    // Show loader
    document.querySelector('.loader').style.display = 'block';

    // Delay form submission
    setTimeout(function() {
        document.getElementById('loginForm').submit();
    }, 2000); // Adjust the delay as needed (2000ms = 2 seconds)

    return false; // Prevent default form submission
}
// scripts.js

document.addEventListener('DOMContentLoaded', function() {
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.style.display = i === index ? 'flex' : 'none';
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    showSlide(currentSlide);
    setInterval(nextSlide, 3000); // Change slide every 3 seconds

    // Notification functionality
    function showNotification(message) {
        const notification = document.getElementById('notification');
        notification.textContent = message;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 5000); // Hide after 5 seconds
    }

    // Example usage:
    // showNotification('Deposit Successful!');
    // showNotification('Withdrawal Successful!');

    // Expose the showNotification function to the global scope for testing
    window.showNotification = showNotification;
});