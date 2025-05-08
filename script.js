// Static rooms (simulate backend)
const rooms = [
    { id: 1, name: "Conference Room A" },
    { id: 2, name: "Conference Room B" },
];

document.addEventListener('DOMContentLoaded', () => {
    const roomSelect = document.getElementById("room");
    const notification = document.getElementById("notification");

    // Populate rooms
    rooms.forEach(room => {
        const option = document.createElement("option");
        option.value = room.id;
        option.textContent = room.name;
        roomSelect.appendChild(option);
    });

    // Handle booking submission
    document.getElementById("bookingForm").addEventListener("submit", function (e) {
        e.preventDefault();

        // In a real app, you would call the backend here (e.g., using fetch)

        // Show notification
        notification.classList.remove("hidden");
        notification.textContent = "Room Booked Successfully ✅";

        // Auto-hide after 3 seconds
        setTimeout(() => {
            notification.classList.add("hidden");
        }, 3000);
    });
});