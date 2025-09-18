<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syschool - {{ $title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --accent-blue: #60a5fa;
            --light-blue: #e0f2fe;
            --white-blue: #f5faff;
            --success-green: #22c55e;
            --light-gray: #e5e7eb;
            --dark-gray: #1f2937;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .sidebar {
            background: linear-gradient(180deg, rgba(30, 64, 175, 0.95) 0%, rgba(59, 130, 246, 0.95) 100%);
            backdrop-filter: blur(8px);
            border-radius: 1rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, opacity 0.3s ease;
            will-change: transform;
            backface-visibility: hidden;
            z-index: 50;
        }

        .sidebar-item {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .sidebar-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar-item.active {
            background: white;
            color: var(--primary-blue);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            transform: scale(1.02);
        }

        .chat-container {
            height: calc(100vh - 200px);
            min-height: 500px;
        }

        .chat-messages {
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
            border: 1px solid var(--border-color);
        }

        .message-bubble {
            max-width: 70%;
            padding: 0.875rem 1rem;
            border-radius: 1.25rem;
            margin-bottom: 0.75rem;
            position: relative;
            word-wrap: break-word;
            animation: messageSlide 0.3s ease-out;
            backface-visibility: hidden;
        }

        @keyframes messageSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .message-student {
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--text-primary);
            align-self: flex-start;
            border-bottom-left-radius: 0.5rem;
        }

        .message-teacher {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 0.5rem;
        }

        .contact-item {
            border-radius: 0.75rem;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .contact-item:hover {
            background: linear-gradient(135deg, var(--light-blue) 0%, rgba(59, 130, 246, 0.1) 100%);
            transform: translateX(4px);
        }

        .contact-item.active {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            color: white;
        }

        .input-modern {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid var(--border-color);
            border-radius: 1.5rem;
            padding: 0.875rem 1.25rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-size: 0.875rem;
        }

        .input-modern:focus {
            outline: none;
            border-color: var(--accent-blue);
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .send-btn {
            background: linear-gradient(135deg, var(--success-green) 0%, #059669 100%);
            width: 2.75rem;
            height: 2.75rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
        }

        .send-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.4);
        }

        .mobile-toggle {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #2563eb 100%);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .status-indicator {
            width: 8px;
            height: 8px;
            background: var(--success-green);
            border-radius: 50%;
            position: absolute;
            top: 8px;
            right: 8px;
            border: 2px solid white;
        }

        .overlay {
            transition: opacity 0.3s ease, visibility 0.3 ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: 16rem;
                transform: translateX(-100%);
                visibility: hidden;
                opacity: 0;
            }

            .sidebar.active {
                transform: translateX(0);
                visibility: visible;
                opacity: 1;
            }

            .main-content {
                margin-left: 0;
                padding: 1rem;
            }

            .chat-container {
                height: calc(100vh - 160px);
            }

            .message-bubble {
                max-width: 85%;
                padding: 0.75rem;
                font-size: 0.875rem;
            }

            .send-btn {
                width: 2.5rem;
                height: 2.5rem;
            }

            #chatLeft {
                display: none;
                position: fixed;
                width: 100%;
                max-width: 16rem;
                z-index: 40;
                background: white;
                border-radius: 0;
                visibility: hidden;
                opacity: 0;
                transform: translateX(-100%);
                transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease;
            }

            #chatLeft.active {
                display: block;
                visibility: visible;
                opacity: 1;
                transform: translateX(0);
            }
        }

        @media (min-width: 769px) {
            .sidebar {
                width: 16rem;
                transform: translateX(0);
                visibility: visible;
                opacity: 1;
                left: 1rem;
                top: 1rem;
                height: 95%;
            }

            .main-content {
                margin-left: 17rem;
                padding: 1.5rem;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .scrollbar-thin {
            scrollbar-width: thin;
            scrollbar-color: var(--border-color) transparent;
        }

        .scrollbar-thin::-webkit-scrollbar {
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: transparent;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 3px;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
    </style>
</head>

<body class="min-h-screen">
