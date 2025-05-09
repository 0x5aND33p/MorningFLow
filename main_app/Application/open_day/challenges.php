<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* General body style: centers everything, sets background image and font */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column; /* Arrange items vertically */
            align-items: center; /* Center horizontally */
            /* justify-content: center; */ /* Remove vertical centering */
            min-height: 100vh;
            background-color: #f0f2f5;
            background-image: url('uniPic.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
        }

        /* Main container holding the entire content */
        .main-container {
            width: 95%;
            max-width: 1200px;
            background-color: rgba(255, 253, 245, 0.95); /* Slightly transparent white */
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            padding: 20px; /* Increased padding */
            box-sizing: border-box;
            margin-top: 20px; /* Add top margin */
        }

        /* Main title styling */
        .title {
            color: #003366;
            font-size: clamp(2.0rem, 3vw, 2.5rem); /* Using rem for font size */
            font-weight: 700;
            text-align: left;
            margin-bottom: 1rem;
        }

        /* Divider line under the title */
        .divider {
            width: 100%;
            height: 3px;
            margin: 0.5rem 0 1rem 0;
            border: none;
            background: linear-gradient(to right, #555 0%, #999 30%, transparent 100%);
        }

        /* Box for each quest */
        .quest {
            background-color: rgba(255, 253, 245, 0.95);
            padding: 15px; /* Increased padding */
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Softer shadow */
            margin-bottom: 1rem; /* Increased margin */
        }

        /* Quest heading */
        .quest h3 {
            margin-top: 0;
            color: #0056b3; /* Darker blue */
            font-size: 1.5rem; /* Adjust font size */
        }

        /* Quest description text */
        .quest p {
            margin-top: 0.5rem;
            color: #333; /* Darker text */
        }

        /* Progress bar container */
        .progress-bar {
            width: 100%;
            height: 12px; /* Slightly thicker */
            background-color: #e9ecef; /* Light gray */
            border-radius: 6px;
            margin-top: 1rem;
            overflow: hidden;
        }

        /* Filled portion of the progress bar */
        .progress {
            height: 100%;
            background-color: #28a745;
            width: 0;
            transition: width 0.3s ease;
            border-radius: 6px;
        }

        /* Container for action buttons */
        .actions {
            margin-top: 2rem;
            text-align: center; /* Center the button */
        }

        /* Button styling */
        .actions button {
            padding: 0.75rem 1.5rem; /* Using rem for padding */
            font-size: 1.25rem; /* Adjust font size */
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.375rem; /* Bootstrap's border-radius */
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075); /* Bootstrap's shadow */
        }

        /* Button hover effect */
        .actions button:hover {
            background-color: #0056b3;
        }

        /* Scanner popup box */
        #qr-scanner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 400px;
            background-color: #fff; /* White background for scanner */
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 1000;
        }

        /* Scanner video feed */
        #qr-scanner video {
            width: 100%;
            border-radius: 10px 10px 0 0;
            box-shadow: none; /* Removed video shadow */
        }

        /* Top bar of the scanner window */
        .scanner-header {
            display: flex;
            justify-content: flex-end;
            padding: 10px;
            background-color: #f8f9fa; /* Light gray background */
            border-radius: 10px 10px 0 0;
            border-bottom: 1px solid #dee2e6; /* Subtle border */
        }

        /* Close button for scanner */
        .close-scanner {
            background: none;
            border: none;
            font-size: 1.5rem; /* Adjust close button size */
            cursor: pointer;
            color: #6c757d; /* Gray close button */
            opacity: 0.8;
        }

        /* Close button hover effect */
        .close-scanner:hover {
            color: #dc3545; /* Red on hover */
            opacity: 1;
        }

        /* Message that appears after completing a quest */
        .completed-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745; /* Green background */
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            z-index: 1001;
            display: none;
        }

        /* Popup modal for rewards */
        #custom-modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff; /* White modal background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Softer shadow */
            z-index: 1002;
            text-align: center;
        }

        /* Modal paragraph text */
        #custom-modal p {
            color: #333;
            margin-bottom: 1rem;
        }

        /* Modal button */
        #custom-modal button {
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: background-color 0.15s ease-in-out;
        }

        /* Modal button hover effect */
        #custom-modal button:hover {
            background-color: #0056b3;
        }

        /* Container for completed quest texts */
        #completed-quests {
            margin-top: 2rem;
            width: 100%;
            max-width: 600px;
        }

        /* Green text shown permanently after completing a quest */
        .permanent-text {
            color: #28a745;
            font-weight: bold;
            margin-top: 0.5rem;
            padding: 10px;
            background-color: #d4edda; /* Light green */
            border-radius: 0.25rem;
            border: 1px solid #c3e6cb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
    </style>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
</head>

<body>
    <?php include("navbar.html"); ?>

    <div class="main-container">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="title">Begin The Challenges</h1>
                <hr class="divider">
                <p class="lead">Follow the instructions in each challenge to unlock exciting rewards.
                    Use the button at the bottom of the page to scan any QR code and get started!</p>
            </div>
        </div>

        <div class="quest-container" id="active-quests"></div>
        <div class="quest-container" id="completed-quests"></div>

        <div class="actions mt-3">
            <button onclick="startQRScanner()" class="btn btn-primary btn-lg">Scan & Earn Rewards</button>
        </div>

        <div id="qr-scanner">
            <div class="scanner-header">
                <button class="close-scanner" onclick="closeQRScanner()">×</button>
            </div>
            <div id="qr-reader"></div>
        </div>

        <div id="completed-message" class="completed-message"></div>
        <div id="custom-modal">
            <p id="modal-message"></p>
            <button onclick="closeModal()" class="btn btn-secondary">OK</button>
        </div>

        <div id="backdrop" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 999;"></div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    const quests = [
        {
            id: 1,
            name: "Explore & Unlock: A Campus Scavenger Hunt",
            description: "Scan QR codes at four different locations to complete the hunt and unlock an exciting reward!",
            locations: ["MI Building", "MA Building", "MC Building", "MD Building"],
            completedLocations: [],
            reward: "Use the keyword 'EX345'. Meet a colleague at any university lab to explore all the software available for you to use during your time at university.",
            isCompleted: false,
        },
        {
            id: 2,
            name: "Chat, Scan, Sip!",
            description: "Connect with 5 university members, scan their QR codes, and enjoy a free coffee on us!",
            locations: [],
            completedLocations: [],
            reward: "Say the phrase 'Love Wlv' to a cafeteria staff member to enjoy a free cappuccino!",
            isCompleted: false,
        },
        {
            id: 3,
            name: "First University Lecture",
            description: "Head to MC001 for the first lecture of your university journey and receive a prize upon completing the lecture!",
            locations: ["MC001"],
            completedLocations: [],
            reward: "Get a free bag filled with goodies—perfect for your time at the University of Wolverhampton!.",
            isCompleted: false,
        },
        {
            id: 4,
            name: "Future Focus: Career Advice",
            description: "Visit the garden, chat with a career advisor, and find out if this path is the right fit for you!",
            locations: ["MA212"],
            completedLocations: [],
            reward: "Receive a Career Planning Guide with valuable tips for exploring and shaping your career path!",
            isCompleted: false,
        },
    ];
    let html5QrCode;

    // Save progress to browser storage
    function saveQuestsToCache() {
        localStorage.setItem("quests", JSON.stringify(quests));
    }
    // Load saved progress if available
    function loadQuestsFromCache() {
        const cached = localStorage.getItem("quests");
        if (cached) {
            const parsed = JSON.parse(cached);
            parsed.forEach((cachedQuest, i) => {
                quests[i].completedLocations = cachedQuest.completedLocations;
                quests[i].isCompleted = cachedQuest.isCompleted;
            });
        }
    }
    // Check if a quest is fully completed and handle reward
    function checkQuestCompletion(quest) {
        if (
            (quest.id === 1 && quest.completedLocations.length === quest.locations.length) ||
            (quest.id === 2 && quest.completedLocations.length === 5) ||
            (quest.id === 3 && quest.completedLocations.length === 1) ||
            (quest.id === 4 && quest.completedLocations.length === 1)
        ) {
            quest.isCompleted = true;
            triggerFireworks();
            setTimeout(() => {
                awardReward(quest.reward);
                addPermanentText(quest.name);
                saveQuestsToCache();
                displayQuests();
            }, 2000);
        } else {
            saveQuestsToCache();
            displayQuests();
        }
    }
    // Show a green banner when a quest is completed
    function addPermanentText(questName) {
        const completedQuestsContainer = document.getElementById("completed-quests");
        if ([...completedQuestsContainer.children].some(el => el.textContent.includes(questName))) {
            return;
        }
        const permanentText = document.createElement("div");
        permanentText.className = "permanent-text";
        permanentText.textContent = `Challenge Completed: ${questName}`;
        completedQuestsContainer.appendChild(permanentText);
    }
    // Show the reward popup
    function awardReward(reward) {
        const modal = document.getElementById("custom-modal");
        const backdrop = document.getElementById("backdrop");
        const modalMessage = document.getElementById("modal-message");
        modalMessage.textContent = `Congratulations! You earned the ${reward}`;
        modal.style.display = "block";
        backdrop.style.display = "block";
    }
    // Close the reward modal
    function closeModal() {
        const modal = document.getElementById("custom-modal");
        const backdrop = document.getElementById("backdrop");
        modal.style.display = "none";
        backdrop.style.display = "none";
    }
    // Launch confetti celebration
    function triggerFireworks() {
        confetti({
            spread: 180,
            ticks: 300,
            gravity: 0.8,
            particleCount: 200,
            origin: { y: 0.6 },
        });
    }