@extends('layouts.app')

@section('title', $siteSetting->site_title ?? 'Portfolio')

@section('content')
<!-- Google Fonts Premium -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/css/glightbox.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/swiper@9.2.0/swiper-bundle.min.css" rel="stylesheet">
<!-- PureCounter CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter.css">
<script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

<style>
/*--------------------------------------------------------------
# CSS Variables - Premium Color Palette
--------------------------------------------------------------*/
:root {
  --primary: #6366f1;
  --primary-dark: #4f46e5;
  --primary-light: #818cf8;
  --secondary: #ec489a;
  --secondary-dark: #db2777;
  --accent: #14b8a6;
  --dark: #0f0f1a;
  --darker: #0a0a0f;
  --light: #ffffff;
  --gray: #94a3b8;
  --glass-bg: rgba(15, 15, 26, 0.7);
  --glass-border: rgba(99, 102, 241, 0.2);
  --gradient-1: linear-gradient(135deg, #6366f1 0%, #ec489a 50%, #14b8a6 100%);
  --gradient-2: linear-gradient(135deg, #4f46e5 0%, #db2777 100%);
  --gradient-3: linear-gradient(135deg, #14b8a6 0%, #6366f1 100%);
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
body {
  font-family: 'Plus Jakarta Sans', sans-serif;
  background-color: var(--darker);
  color: var(--light);
  position: relative;
  line-height: 1.6;
}

body::before {
  content: "";
  position: fixed;
  background: url('{{ $siteSetting && $siteSetting->background_image ? asset("storage/images/" . $siteSetting->background_image) : "" }}') center/cover no-repeat;
  left: 0;
  right: 0;
  top: 0;
  height: 100vh;
  z-index: -1;
  opacity: 0.1;
}

body::after {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.1), transparent 50%);
  z-index: -1;
  pointer-events: none;
}

@media (min-width: 1024px) {
  body::before {
    background-attachment: fixed;
  }
}

a {
  color: var(--primary-light);
  text-decoration: none;
  transition: all 0.3s ease;
}

a:hover {
  color: var(--secondary);
}

/*--------------------------------------------------------------
# Loader/Spinner Styles
--------------------------------------------------------------*/
.loader-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(10, 10, 15, 0.95);
  backdrop-filter: blur(10px);
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
  transition: opacity 0.5s ease, visibility 0.5s ease;
}

.loader-wrapper.hidden {
  opacity: 0;
  visibility: hidden;
}

.spinner {
  width: 60px;
  height: 60px;
  position: relative;
  animation: spin 1s linear infinite;
}

.spinner .circle {
  position: absolute;
  width: 100%;
  height: 100%;
  border-radius: 50%;
  border: 3px solid transparent;
  border-top-color: var(--primary);
  border-bottom-color: var(--secondary);
}

.spinner .circle:nth-child(2) {
  width: 80%;
  height: 80%;
  top: 10%;
  left: 10%;
  border-top-color: var(--accent);
  border-bottom-color: var(--primary-light);
  animation: spin 0.8s linear infinite reverse;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

.loader-text {
  position: absolute;
  bottom: -40px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 0.9rem;
  color: var(--primary-light);
  white-space: nowrap;
  letter-spacing: 1px;
}

/* Toast Notification Styles */
.toast-notification {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 10000;
  min-width: 320px;
  max-width: 400px;
  background: var(--glass-bg);
  backdrop-filter: blur(10px);
  /* border-radius: 12px; */
  padding: 0;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  animation: slideInRight 0.3s ease;
  border: 1px solid rgba(99, 102, 241, 0.2);
  overflow: hidden;
}

.toast-notification.hide {
  animation: slideOutRight 0.3s ease forwards;
}

.toast-content {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  gap: 12px;
}

.toast-icon {
  font-size: 24px;
  flex-shrink: 0;
}

.toast-message {
  flex: 1;
  font-size: 14px;
  line-height: 1.5;
  color: white;
}

.toast-close {
  background: none;
  border: none;
  color: rgba(255, 255, 255, 0.6);
  cursor: pointer;
  font-size: 20px;
  padding: 0;
  transition: color 0.2s;
}

.toast-close:hover {
  color: white;
}

.toast-progress {
  height: 3px;
  width: 100%;
  background: rgba(255, 255, 255, 0.3);
}

.toast-progress-bar {
  height: 100%;
  width: 100%;
  background: white;
  animation: progress 5s linear forwards;
}

.toast-success .toast-icon { color: #10b981; }
.toast-success .toast-progress-bar { background: #10b981; }
.toast-success { border-top: 3px solid #10b981; }

.toast-error .toast-icon { color: #ef4444; }
.toast-error .toast-progress-bar { background: #ef4444; }
.toast-error { border-top: 3px solid #ef4444; }

.toast-info .toast-icon { color: #3b82f6; }
.toast-info .toast-progress-bar { background: #3b82f6; }
.toast-info { border-top: 3px solid #3b82f6; }

@keyframes slideInRight {
  from {
    transform: translateX(100%);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slideOutRight {
  from {
    transform: translateX(0);
    opacity: 1;
  }
  to {
    transform: translateX(100%);
    opacity: 0;
  }
}

@keyframes progress {
  from { width: 100%; }
  to { width: 0%; }
}

/* Header Styles */
#header {
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  z-index: 997;
}

#header * {
  transition: all 0.4s ease;
}

#header h3 {
  font-size: 1.5rem;
  font-weight: 500;
  margin-bottom: 1.5rem;
  letter-spacing: 0.05em;
  background: linear-gradient(135deg, var(--gray), var(--light));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  animation: fadeInUp 0.8s ease;
  font-family: 'Space Grotesk', monospace;
}

#header h3 .wave {
  display: inline-block;
  font-size: 2rem;
  filter: drop-shadow(0 0 10px rgba(236, 72, 153, 0.5));
}

#header h1 {
  font-size: 5rem;
  margin: 0;
  padding: 0;
  line-height: 1.2;
  font-weight: 800;
  font-family: 'Space Grotesk', sans-serif;
  background: var(--gradient-1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  background-size: 200% auto;
  animation: gradientShift 8s ease infinite, fadeInUp 0.8s ease 0.2s both;
  letter-spacing: -0.02em;
  text-shadow: 0 0 30px rgba(99, 102, 241, 0.3);
}

@keyframes gradientShift {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(40px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.typing-container {
  margin: 1rem 0;
}

#header h2 {
  font-size: 2rem;
  font-weight: 500;
  margin: 0;
  color: rgba(255, 255, 255, 0.9);
  font-family: 'Inter', sans-serif;
  letter-spacing: -0.01em;
  display: inline-block;
}

#header h2 span {
  background: var(--gradient-2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  font-weight: 700;
  position: relative;
}

.cursor {
  display: inline-block;
  width: 3px;
  margin-left: 4px;
  background: var(--primary);
  animation: blink 1s infinite;
}

@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

#header .social-links {
  margin-top: 2rem;
  margin-bottom: 2rem;
  display: flex;
  gap: 1rem;
  animation: fadeInUp 0.8s ease 0.4s both;
}

#header .social-links a {
  font-size: 1.2rem;
  display: flex;
  justify-content: center;
  align-items: center;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  color: var(--light);
  border-radius: 50%;
  width: 50px;
  height: 50px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border: 1px solid rgba(99, 102, 241, 0.3);
  position: relative;
  overflow: hidden;
}

#header .social-links a::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: var(--gradient-2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: width 0.5s, height 0.5s;
  z-index: -1;
}

#header .social-links a:hover::before {
  width: 100%;
  height: 100%;
}

#header .social-links a:hover {
  transform: translateY(-5px) scale(1.1);
  border-color: transparent;
  color: white;
}

.download-button {
  padding: 1rem 2.5rem;
  margin-top: 2rem;
  font-size: 1rem;
  font-weight: 600;
  color: var(--light);
  background: var(--gradient-2);
  border: none;
  border-radius: 50px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
  transition: all 0.4s ease;
  box-shadow: 0 5px 20px rgba(99, 102, 241, 0.3);
  font-family: 'Inter', sans-serif;
  letter-spacing: 0.5px;
  animation: fadeInUp 0.8s ease 0.6s both;
}

.download-button::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.6s;
}

.download-button:hover::before {
  left: 100%;
}

.download-button:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 30px rgba(99, 102, 241, 0.5);
}

.download-button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.download-button:disabled:hover {
  transform: none;
  box-shadow: 0 5px 20px rgba(99, 102, 241, 0.3);
}

@media (max-width: 992px) {
  #header h1 {
    font-size: 3rem;
  }
  #header h2 {
    font-size: 1.5rem;
  }
  #header h3 {
    font-size: 1.2rem;
  }
  #header .social-links a {
    width: 45px;
    height: 45px;
    font-size: 1rem;
  }
}

#header.header-top {
  height: 85px;
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  background: rgba(10, 10, 15, 0.95);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(99, 102, 241, 0.2);
  z-index: 998;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
}

#header.header-top .download-button,
#header.header-top h3,
#header.header-top .typing-container,
#header.header-top .social-links {
  display: none !important;
}

#header.header-top .container {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-direction: row;
  text-align: left;
  padding: 0 2rem;
}

#header.header-top h1 {
  margin-right: auto;
  font-size: 1.8rem;
  margin-bottom: 0;
  animation: none;
  background: var(--gradient-1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* Navigation Styles */
.navbar {
  padding: 0;
}

.navbar ul {
  margin: 0;
  padding: 0;
  display: flex;
  list-style: none;
  gap: 2rem;
}

.navbar a {
  font-family: 'Inter', sans-serif;
  font-size: 1rem;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.8);
  position: relative;
  padding: 0.5rem 0;
  letter-spacing: 0.3px;
}

.navbar a::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background: var(--gradient-2);
  transition: width 0.3s ease;
  border-radius: 2px;
}

.navbar a:hover::after,
.navbar .active::after {
  width: 100%;
}

.navbar a:hover,
.navbar .active {
  color: white;
}

.mobile-nav-toggle {
  display: none;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(99, 102, 241, 0.3);
  border-radius: 12px;
  padding: 8px 12px;
  backdrop-filter: blur(10px);
}

@media (max-width: 991px) {
  .mobile-nav-toggle {
    display: block;
  }
  .navbar ul {
    position: fixed;
    top: 0;
    right: -100%;
    width: 80%;
    max-width: 320px;
    height: 100vh;
    background: rgba(10, 10, 15, 0.98);
    backdrop-filter: blur(20px);
    flex-direction: column;
    padding: 100px 2rem 2rem;
    transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1000;
    gap: 1.5rem;
    border-left: 1px solid rgba(99, 102, 241, 0.3);
  }
  .navbar ul.navbar-mobile {
    right: 0;
  }
  .navbar a {
    font-size: 1.1rem;
    padding: 0.8rem 0;
    width: 100%;
    text-align: center;
  }
}

/* Sections Styles */
section {
  overflow: hidden;
  position: absolute;
  width: 100%;
  top: 140px;
  bottom: 100%;
  opacity: 0;
  visibility: hidden;
  transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  z-index: 2;
}

section.section-show {
  top: 100px;
  bottom: auto;
  opacity: 1;
  visibility: visible;
  padding-bottom: 60px;
}

section .container {
  background: var(--glass-bg);
  backdrop-filter: blur(20px);
  border: 1px solid var(--glass-border);
  border-radius: 32px;
  padding: 3rem;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

@media (max-width: 768px) {
  section {
    top: 120px;
  }
  section.section-show {
    top: 85px;
  }
  section .container {
    padding: 1.5rem;
  }
}

.section-title {
  text-align: center;
  margin-bottom: 3rem;
  position: relative;
}

.section-title h2 {
  font-size: 0.9rem;
  font-weight: 600;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--primary-light);
  margin-bottom: 1rem;
  font-family: 'Space Grotesk', monospace;
}

.section-title h2::after {
  content: "";
  width: 60px;
  height: 2px;
  display: inline-block;
  background: var(--gradient-2);
  margin: 0 12px;
  vertical-align: middle;
}

.section-title p {
  font-size: 2.5rem;
  font-weight: 800;
  font-family: 'Space Grotesk', sans-serif;
  background: var(--gradient-1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 0;
  letter-spacing: -0.02em;
}

@media (max-width: 768px) {
  .section-title p {
    font-size: 1.8rem;
  }
}

/* About Section */
.about-me .content h3 {
  font-size: 2rem;
  font-weight: 700;
  background: var(--gradient-2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
}

.about-me .content ul li {
  padding: 0.75rem 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.about-me .content ul li strong {
  color: var(--primary-light);
  min-width: 100px;
  display: inline-block;
}

.about-me .content ul li i {
  color: var(--primary);
  font-size: 1.2rem;
}

/* Counts */
.counts {
  margin-top: 2rem;
}

.counts .count-box {
  background: rgba(255, 255, 255, 0.03);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(99, 102, 241, 0.2);
  border-radius: 24px;
  transition: all 0.4s ease;
  text-align: center;
  padding: 2rem 1.5rem;
  position: relative;
}

.counts .count-box:hover {
  transform: translateY(-10px);
  border-color: var(--primary);
  box-shadow: 0 20px 40px -20px rgba(99, 102, 241, 0.4);
}

.counts .count-box i {
  font-size: 2rem;
  background: var(--gradient-2);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  margin-bottom: 1rem;
  display: inline-block;
}

.counts .count-box span {
  font-size: 2.5rem;
  font-weight: 800;
  display: block;
  background: var(--gradient-1);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.counts .count-box p {
  margin-top: 0.5rem;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.7);
}

/* Skills */
.skills {
  margin-top: 3rem;
}

.skills-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
  margin-top: 2rem;
}

.skill-card {
  backdrop-filter: blur(10px);
  padding: 1rem;
  transition: all 0.4s ease;
}

.skill-card:hover {
  transform: translateY(-5px);
  background: rgba(99, 102, 241, 0.05);
  box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
}

.skill-item {
  margin-bottom: 1.5rem;
}

.skill-item:last-child {
  margin-bottom: 0;
}

.skill-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 0.75rem;
}

.skill-name {
  font-size: 0.9rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: var(--light);
  font-family: 'Inter', sans-serif;
  position: relative;
  padding-left: 12px;
}

.skill-name::before {
  content: '';
  position: absolute;
  left: 0;
  top: 50%;
  transform: translateY(-50%);
  width: 6px;
  height: 6px;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  border-radius: 2px;
}

.progress-bar-wrap {
  background: rgba(255, 255, 255, 0.08);
  overflow: hidden;
  height: 10px;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.2);
}

.progress-bar {
  background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
  height: 100%;
  position: relative;
  overflow: hidden;
  width: 0%;
  transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 0 5px rgba(99, 102, 241, 0.3);
}

.progress-bar::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  animation: shimmer 2s infinite;
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(100%); }
}

/* Interests */
.interests {
  margin-top: 3rem;
}

.interests .icon-box {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(99, 102, 241, 0.2);
  border-radius: 20px;
  padding: 1.5rem;
  text-align: center;
  transition: all 0.4s ease;
}

.interests .icon-box:hover {
  transform: translateY(-5px);
  border-color: var(--primary);
  background: rgba(99, 102, 241, 0.1);
}

.interests .icon-box i {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  display: inline-block;
  transition: transform 0.3s ease;
}

.interests .icon-box:hover i {
  transform: scale(1.1);
}

.interests .icon-box h3 {
  font-size: 1rem;
  font-weight: 600;
  margin: 0;
  color: var(--light);
}

/* Resume */
.resume .resume-title {
  font-size: 1.5rem;
  font-weight: 700;
  margin-bottom: 1.5rem;
  color: var(--light);
  font-family: 'Space Grotesk', sans-serif;
}

.resume .resume-item {
  padding: 0 0 1.5rem 2rem;
  border-left: 2px solid var(--primary);
  position: relative;
  margin-bottom: 1.5rem;
}

.resume .resume-item::before {
  content: '';
  position: absolute;
  left: -9px;
  top: 0;
  width: 16px;
  height: 16px;
  background: var(--gradient-2);
  border-radius: 50%;
  box-shadow: 0 0 10px var(--primary);
}

.resume .resume-item h4 {
  font-size: 1.25rem;
  font-weight: 700;
  color: var(--primary-light);
  margin-bottom: 0.5rem;
}

.resume .resume-item h5 {
  background: rgba(99, 102, 241, 0.2);
  padding: 0.25rem 1rem;
  border-radius: 20px;
  font-size: 0.8rem;
  display: inline-block;
  margin-bottom: 1rem;
  font-weight: 500;
}

.resume .resume-item p {
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 0;
  line-height: 1.6;
}

/* Services */
.services .icon-box {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(99, 102, 241, 0.2);
  border-radius: 24px;
  padding: 2rem;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
  text-align: center;
  height: 100%;
}

.services .icon-box::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: var(--gradient-2);
  opacity: 0;
  transition: opacity 0.4s ease;
  z-index: 0;
}

.services .icon-box:hover::before {
  opacity: 1;
}

.services .icon-box .icon,
.services .icon-box h4,
.services .icon-box p {
  position: relative;
  z-index: 1;
}

.services .icon-box .icon {
  width: 70px;
  height: 70px;
  background: rgba(99, 102, 241, 0.2);
  border-radius: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 1.5rem;
  transition: all 0.4s ease;
}

.services .icon-box .icon i {
  font-size: 2rem;
  color: var(--light);
  transition: all 0.4s ease;
}

.services .icon-box:hover .icon {
  background: white;
  transform: rotateY(360deg);
}

.services .icon-box:hover .icon i {
  color: var(--primary);
}

.services .icon-box h4 {
  font-size: 1.3rem;
  font-weight: 700;
  margin-bottom: 1rem;
  color: var(--light);
}

.services .icon-box p {
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.6;
  margin-bottom: 0;
}

.services .icon-box:hover h4,
.services .icon-box:hover p {
  color: white;
}

/* Portfolio */
.portfolio #portfolio-flters {
  padding: 0;
  margin: 0 0 2rem 0;
  list-style: none;
  text-align: center;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 0.75rem;
}

.portfolio #portfolio-flters li {
  cursor: pointer;
  display: inline-block;
  padding: 0.6rem 1.5rem;
  font-size: 0.9rem;
  font-weight: 600;
  line-height: 1;
  text-transform: uppercase;
  color: #fff;
  background: rgba(255, 255, 255, 0.05);
  margin: 0;
  transition: all 0.3s ease;
  border-radius: 30px;
  letter-spacing: 0.5px;
}

.portfolio #portfolio-flters li:hover,
.portfolio #portfolio-flters li.filter-active {
  background: var(--gradient-2);
  transform: translateY(-2px);
}

.portfolio .portfolio-wrap {
  overflow: hidden;
  position: relative;
  margin-bottom: 1.5rem;
}

.portfolio .portfolio-wrap img {
  width: 100%;
  height: 250px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.portfolio .portfolio-wrap:hover img {
  transform: scale(1.1);
}

.portfolio .portfolio-wrap .portfolio-info {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(99, 102, 241, 0.9), rgba(236, 72, 153, 0.9));
  backdrop-filter: blur(5px);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  opacity: 0;
  transition: all 0.4s ease;
  padding: 1rem;
  text-align: center;
}

.portfolio .portfolio-wrap:hover .portfolio-info {
  opacity: 1;
}

.portfolio .portfolio-wrap .portfolio-info h4 {
  font-size: 1.2rem;
  font-weight: 700;
  margin-bottom: 0.5rem;
  color: white;
}

.portfolio .portfolio-wrap .portfolio-info p {
  font-size: 0.85rem;
  color: rgba(255, 255, 255, 0.9);
  margin-bottom: 1rem;
  text-transform: uppercase;
}

.portfolio .portfolio-wrap .portfolio-links {
  display: flex;
  gap: 1rem;
}

.portfolio .portfolio-wrap .portfolio-links a {
  color: white;
  font-size: 1.3rem;
  transition: all 0.3s ease;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
}

.portfolio .portfolio-wrap .portfolio-links a:hover {
  background: white;
  color: var(--primary);
  transform: scale(1.1);
}

/* Contact Section */
.contact-wrapper {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
  margin-bottom: 2.5rem;
}

.contact-info-card {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(99, 102, 241, 0.2);
  border-radius: 24px;
  padding: 1.8rem;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.contact-info-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: var(--gradient-2);
  opacity: 0;
  transition: opacity 0.4s ease;
  z-index: 0;
}

.contact-info-card:hover::before {
  opacity: 0.1;
}

.contact-info-card:hover {
  transform: translateY(-5px);
  border-color: var(--primary);
}

.contact-icon {
  width: 55px;
  height: 55px;
  background: var(--gradient-2);
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1.2rem;
  position: relative;
  z-index: 1;
  box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
}

.contact-icon i {
  font-size: 1.8rem;
  color: white;
}

.contact-info-card h3 {
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 0.6rem;
  color: var(--primary-light);
  position: relative;
  z-index: 1;
}

.contact-info-card p {
  color: rgba(255, 255, 255, 0.8);
  margin-bottom: 0;
  font-size: 0.95rem;
  position: relative;
  z-index: 1;
  word-break: break-word;
}

.contact-social-links {
  display: flex;
  gap: 0.8rem;
  margin-top: 1rem;
  flex-wrap: wrap;
  position: relative;
  z-index: 1;
}

.contact-social-links a {
  width: 38px;
  height: 38px;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  transition: all 0.3s ease;
  border: 1px solid rgba(99, 102, 241, 0.3);
}

.contact-social-links a:hover {
  background: var(--gradient-2);
  transform: translateY(-3px);
  border-color: transparent;
}

.contact-form-container {
  background: rgba(255, 255, 255, 0.02);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(99, 102, 241, 0.2);
  border-radius: 32px;
  padding: 2rem;
  margin-top: 0;
}

.contact-form-modern {
  display: flex;
  flex-direction: column;
  gap: 1.2rem;
}

.form-row-modern {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1.2rem;
}

.form-group-modern {
  position: relative;
}

.form-group-modern input,
.form-group-modern textarea {
  width: 100%;
  padding: 1rem 1.2rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(99, 102, 241, 0.2);
  /* border-radius: 20px; */
  color: white;
  font-family: 'Inter', sans-serif;
  font-size: 0.95rem;
  transition: all 0.3s ease;
}

.form-group-modern input:focus,
.form-group-modern textarea:focus {
  outline: none;
  border-color: var(--primary);
  background: rgba(99, 102, 241, 0.1);
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(99, 102, 241, 0.2);
}

.form-group-modern input::placeholder,
.form-group-modern textarea::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

.form-group-modern textarea {
  resize: none;
  min-height: 120px;
}

.submit-btn-modern {
  padding: 1rem 2rem;
  background: var(--gradient-2);
  border: none;
  border-radius: 50px;
  color: white;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
  width: auto;
  min-width: 180px;
  margin-top: 0.5rem;
}

.submit-btn-modern::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
  transition: left 0.6s;
}

.submit-btn-modern:hover::before {
  left: 100%;
}

.submit-btn-modern:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
}

@media (max-width: 992px) {
  .contact-wrapper {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .form-row-modern {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .contact-form-container {
    padding: 1.5rem;
  }
}

@media (max-width: 768px) {
  .contact-info-card {
    padding: 1.2rem;
  }
  .contact-icon {
    width: 45px;
    height: 45px;
  }
  .contact-icon i {
    font-size: 1.4rem;
  }
  .skills-grid {
    grid-template-columns: 1fr;
    gap: 1rem;
  }
  .skill-card {
    padding: 1.2rem;
  }
}

.wave {
  animation: wave-animation 2.5s infinite;
  transform-origin: 70% 70%;
  display: inline-block;
}

@keyframes wave-animation {
  0% { transform: rotate(0deg); }
  10% { transform: rotate(14deg); }
  20% { transform: rotate(-8deg); }
  30% { transform: rotate(14deg); }
  40% { transform: rotate(-4deg); }
  50% { transform: rotate(10deg); }
  60% { transform: rotate(0deg); }
  100% { transform: rotate(0deg); }
}

::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-track {
  background: var(--darker);
}

::-webkit-scrollbar-thumb {
  background: var(--gradient-2);
  border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
  background: var(--primary);
}
</style>

<!-- Loader -->
<div class="loader-wrapper" id="loader">
  <div class="spinner">
    <div class="circle"></div>
    <div class="circle"></div>
  </div>
  <div class="loader-text">Loading...</div>
</div>

<!-- Toast Container -->
<div id="toastContainer"></div>

<!-- Header -->
<header id="header">
  <div class="container">
    <h3>Hello, it's <span class="wave">👋</span></h3>
    <h1>{{ $about->title ?? 'Portfolio' }}</h1>
    <div class="typing-container">
      <h2>I'm a <span id="typed-text"></span><span class="cursor">|</span></h2>
    </div>
    <div class="social-links">
      @foreach($socialMedia as $social)
        <a href="{{ $social->link }}" target="_blank"><i class="bi bi-{{ $social->icon }}"></i></a>
      @endforeach
    </div>

    <nav id="navbar" class="navbar">
      <button class="mobile-nav-toggle"><i class="bi bi-list"></i></button>
      <ul>
        <li><a class="nav-link scrollto active" href="#header">Home</a></li>
        <li><a class="nav-link scrollto" href="#about">About</a></li>
        <li><a class="nav-link scrollto" href="#resume">Resume</a></li>
        {{-- <li><a class="nav-link scrollto" href="#services">Services</a></li> --}}
        <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
        <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
      </ul>
    </nav>

    <button onclick="window.open('{{ $about && $about->cv ? asset('storage/documents/' . $about->cv) : '#' }}', '_blank')" class="download-button" @if(!$about || !$about->cv)disabled @endif>
      <i class="bi bi-download mr-2"></i>Download CV
    </button>
  </div>
</header>

<!-- About Section -->
<section id="about" class="about">
  <div class="container">
    <div class="about-me">
      <div class="section-title">
        <h2>About</h2>
        {{-- <p>Learn more about me</p> --}}
      </div>

      <div class="row">
        <div class="col-lg-4">
          @if($about && $about->profile_pic)
            <img src="{{ asset('storage/images/' . $about->profile_pic) }}" class="img-fluid" alt="">
          @endif
        </div>
        <div class="col-lg-8 pt-4 pt-lg-0 content">
          <h3>{{ $about->title ?? '' }}</h3>
          <p class="">-- {{ $about->subtitle ?? '' }}</p>
          <div class="row">
            @php $counter = 0; @endphp
            @foreach($personalInfos as $info)
              @if($counter % 2 == 0)
                <div class="row">
              @endif
              <div class="col-lg-6">
                <ul>
                  <li><i class="bi bi-chevron-right"></i> <strong>{{ $info->info_title }}:</strong> <span>{{ $info->info_desc }}</span></li>
                </ul>
              </div>
              @if($counter % 2 != 0 || $loop->last)
                </div>
              @endif
              @php $counter++; @endphp
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <!-- Counts -->
    <div class="counts">
      <div class="row">
        @foreach($counters as $counter)
          <div class="col-lg-3 col-md-6 mt-4">
            <div class="count-box">
              <i class="{{ $counter->counter_icon }}"></i>
              <span data-purecounter-start="{{ $counter->pre_value }}" data-purecounter-end="{{ $counter->post_value }}" data-purecounter-duration="1" class="purecounter"></span>
              <p>{{ $counter->counter_title }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Skills -->
    <div class="skills">
      <div class="section-title">
        <h2>Skills</h2>
        {{-- <p>My Technical Skills</p> --}}
      </div>

      <div class="skills-grid">
        @php
          $skillPairs = array_chunk($skills->toArray(), 1);
        @endphp

        @foreach($skillPairs as $pair)
          <div class="skill-card">
            @foreach($pair as $skill)
              <div class="skill-item">
                <div class="skill-info">
                  <span class="skill-name">{{ $skill['skill_name'] }}</span>
                </div>
                <div class="progress-bar-wrap">
                  <div class="progress-bar"
                       data-percent="{{ $skill['skill_level'] }}"
                       style="width: 0%"></div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>

    <!-- Interests -->
    <div class="interests">
      <div class="section-title">
        <h2>Interests</h2>
        {{-- <p>What I Love</p> --}}
      </div>
      <div class="row">
        @foreach($interests as $interest)
          <div class="col-lg-3 col-md-4 mt-4">
            <div class="icon-box">
              <i class="{{ $interest->interest_icon }}" style="color: #{{ $interest->color }};"></i>
              <h3>{{ $interest->interest_title }}</h3>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Resume Section -->
<section id="resume" class="resume">
  <div class="container">
    <div class="section-title">
      <h2>Check My Resume</h2>
      {{-- <p>Check My Resume</p> --}}
    </div>

    <div class="row">
      <div class="col-lg-6">
        <h3 class="resume-title">Education</h3>
        @foreach($educations as $education)
          <div class="resume-item">
            <h4>{{ $education->title }}</h4>
            <h5>{{ $education->date }}</h5>
            <p><em>{{ $education->location }}</em></p>
            <p>{{ $education->description }}</p>
          </div>
        @endforeach
      </div>

      <div class="col-lg-6">
        <h3 class="resume-title">Professional Experience</h3>
        @foreach($experiences as $experience)
          <div class="resume-item">
            <h4>{{ $experience->title }}</h4>
            <h5>{{ $experience->date }}</h5>
            <p><em>{{ $experience->location }}</em></p>
            <p>{{ $experience->description }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
{{-- <section id="services" class="services">
  <div class="container">
    <div class="section-title">
      <h2>Services</h2>
      <p>My Services</p>
    </div>

    <div class="row">
      @foreach($services as $service)
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
          <div class="icon-box">
            <div class="icon"><i class="{{ $service->icon }}"></i></div>
            <h4>{{ $service->title }}</h4>
            <p>{{ $service->text }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section> --}}

<!-- Portfolio Section -->
<section id="portfolio" class="portfolio">
  <div class="container">
    <div class="section-title">
      <h2>My Works</h2>
      {{-- <p>My Works</p> --}}
    </div>

    <div class="row">
      <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
          <li data-filter="*" class="filter-active">All</li>
          @foreach($categories as $category)
            <li data-filter=".{{ $category->slug }}">{{ $category->name }}</li>
          @endforeach
        </ul>
      </div>
    </div>

    <div class="row portfolio-container">
      @foreach($portfolios as $portfolio)
        <div class="col-lg-4 col-md-6 portfolio-item {{ $portfolio->category->slug }}">
          <div class="portfolio-wrap">
            <img src="{{ asset('storage/images/' . $portfolio->image) }}" class="img-fluid" alt="{{ $portfolio->title }}">
            <div class="portfolio-info">
              <h4>{{ $portfolio->title }}</h4>
              <p>{{ $portfolio->category->name }}</p>
              <div class="portfolio-links">
                <a href="{{ asset('storage/images/' . $portfolio->image) }}" data-gallery="portfolioGallery" class="portfolio-lightbox" title="{{ $portfolio->title }}"><i class="bx bx-plus"></i></a>
                <a href="{{ route('portfolio.details', $portfolio->id) }}" data-gallery="portfolioDetailsGallery" data-glightbox="type: external" class="portfolio-details-lightbox" title="Portfolio Details"><i class="bx bx-link"></i></a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Contact Section -->
<section id="contact" class="contact">
  <div class="container">
    <div class="section-title">
      <h2>Contact</h2>
      <p>Get In Touch</p>
    </div>

    <div class="contact-wrapper">
      <div class="contact-info-card">
        <div class="contact-icon">
          <i class="bx bx-map"></i>
        </div>
        <h3>My Address</h3>
        <p>{{ $contactInfo->address ?? '123 Street, City, Country' }}</p>
      </div>

      <div class="contact-info-card">
        <div class="contact-icon">
          <i class="bx bx-envelope"></i>
        </div>
        <h3>Email Me</h3>
        <p>{{ $contactInfo->email ?? 'hello@example.com' }}</p>
      </div>

      <div class="contact-info-card">
        <div class="contact-icon">
          <i class="bx bx-phone-call"></i>
        </div>
        <h3>Call Me</h3>
        <p>{{ $contactInfo->phone ?? '+123 456 7890' }}</p>
      </div>

      <div class="contact-info-card">
        <div class="contact-icon">
          <i class="bx bx-share-alt"></i>
        </div>
        <h3>Social Profiles</h3>
        <div class="contact-social-links">
          @foreach($socialMedia as $social)
            <a href="{{ $social->link }}" target="_blank"><i class="bi bi-{{ $social->icon }}"></i></a>
          @endforeach
        </div>
      </div>
    </div>

    <div class="contact-form-container">
      <div class="section-title">
        <p>Send Me a Message</p>
      </div>

      <form action="{{ route('contact.send') }}" method="POST" class="contact-form-modern" id="contactForm">
        @csrf
        <div class="form-row-modern">
          <div class="form-group-modern">
            <input type="text" name="name" placeholder="Your Name" required>
          </div>
          <div class="form-group-modern">
            <input type="email" name="email" placeholder="Your Email" required>
          </div>
        </div>
        <div class="form-group-modern">
          <input type="text" name="subject" placeholder="Subject" required>
        </div>
        <div class="form-group-modern">
          <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
        </div>
        <div class="text-center">
          <button type="submit" class="submit-btn-modern" id="submitBtn">
            <span class="btn-text">Send Message</span>
            <span class="btn-loader" style="display: none;">
              <i class="bi bi-arrow-repeat spin-icon"></i> Sending...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox@3.2.0/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9.2.0/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/waypoints@4.0.1/lib/noframework.waypoints.min.js"></script>

<script>
// Toast Notification Function
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const toastId = 'toast_' + Date.now();

    const icons = {
        success: '<i class="bi bi-check-circle-fill"></i>',
        error: '<i class="bi bi-x-circle-fill"></i>',
        info: '<i class="bi bi-info-circle-fill"></i>'
    };

    const toastHtml = `
        <div id="${toastId}" class="toast-notification toast-${type}">
            <div class="toast-content">
                <div class="toast-icon">${icons[type]}</div>
                <div class="toast-message">${message}</div>
                <button class="toast-close" onclick="closeToast('${toastId}')">&times;</button>
            </div>
            <div class="toast-progress">
                <div class="toast-progress-bar"></div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', toastHtml);

    // Auto close after 5 seconds
    setTimeout(() => {
        closeToast(toastId);
    }, 5000);
}

function closeToast(toastId) {
    const toast = document.getElementById(toastId);
    if (toast) {
        toast.classList.add('hide');
        setTimeout(() => {
            toast.remove();
        }, 300);
    }
}

// Hide loader when page loads
window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    setTimeout(function() {
        loader.classList.add('hidden');
    }, 500);

    // Show session messages
    @if(session('success'))
        showToast('{{ session('success') }}', 'success');
    @endif

    @if(session('error'))
        showToast('{{ session('error') }}', 'error');
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            showToast('{{ $error }}', 'error');
        @endforeach
    @endif
});

// Typing effect
document.addEventListener('DOMContentLoaded', function() {
    const subtitles = {!! json_encode(explode(',', $about->subtitle ?? 'Developer,Designer,Creator')) !!};
    let currentIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    const typedTextElement = document.getElementById('typed-text');

    function typeEffect() {
        if (!typedTextElement) return;
        const currentSubtitle = subtitles[currentIndex];

        if (isDeleting) {
            typedTextElement.textContent = currentSubtitle.substring(0, charIndex - 1);
            charIndex--;
        } else {
            typedTextElement.textContent = currentSubtitle.substring(0, charIndex + 1);
            charIndex++;
        }

        if (!isDeleting && charIndex === currentSubtitle.length) {
            isDeleting = true;
            setTimeout(typeEffect, 2000);
            return;
        }

        if (isDeleting && charIndex === 0) {
            isDeleting = false;
            currentIndex = (currentIndex + 1) % subtitles.length;
            setTimeout(typeEffect, 500);
            return;
        }

        setTimeout(typeEffect, isDeleting ? 50 : 100);
    }

    typeEffect();
});

// Form submission handler
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function() {
            const submitBtn = document.getElementById('submitBtn');
            if (submitBtn) {
                const btnText = submitBtn.querySelector('.btn-text');
                const btnLoader = submitBtn.querySelector('.btn-loader');
                if (btnText && btnLoader) {
                    btnText.style.display = 'none';
                    btnLoader.style.display = 'inline-flex';
                }
                submitBtn.disabled = true;
            }
        });
    }
});

// PureCounter initialization
document.addEventListener('DOMContentLoaded', function() {
    if (typeof PureCounter !== 'undefined') {
        new PureCounter();
    } else {
        const counters = document.querySelectorAll('.purecounter');
        counters.forEach(counter => {
            const target = parseInt(counter.getAttribute('data-purecounter-end'));
            const duration = 2000;
            const step = Math.ceil(duration / 50);
            const increment = target / step;
            let current = 0;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current);
            }, 50);
        });
    }
});

// Main functionality
(function() {
    const select = (el, all = false) => {
        el = el.trim();
        if (all) return [...document.querySelectorAll(el)];
        return document.querySelector(el);
    };

    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) selectEl.forEach(e => e.addEventListener(type, listener));
            else selectEl.addEventListener(type, listener);
        }
    };

    const scrollto = (el) => {
        let element = select(el);
        if (element) {
            window.scrollTo({
                top: element.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    };

    on('click', '.mobile-nav-toggle', function() {
        const navbar = select('#navbar');
        navbar.classList.toggle('navbar-mobile');
        this.classList.toggle('bi-list');
        this.classList.toggle('bi-x');
    });

    on('click', '#navbar .nav-link', function(e) {
        let section = select(this.hash);
        if (section) {
            e.preventDefault();

            const header = select('#header');
            const sections = select('section', true);
            const navlinks = select('#navbar .nav-link', true);

            navlinks.forEach(item => item.classList.remove('active'));
            this.classList.add('active');

            if (select('#navbar').classList.contains('navbar-mobile')) {
                select('#navbar').classList.remove('navbar-mobile');
                const toggle = select('.mobile-nav-toggle');
                toggle.classList.toggle('bi-list');
                toggle.classList.toggle('bi-x');
            }

            sections.forEach(item => item.classList.remove('section-show'));
            section.classList.add('section-show');

            if (this.hash == '#header') header.classList.remove('header-top');
            else header.classList.add('header-top');

            scrollto(this.hash);
        }
    }, true);

    window.addEventListener('scroll', () => {
        const header = select('#header');
        if (window.scrollY > 100) header.classList.add('header-top');
        else {
            const activeSection = select('section.section-show');
            if (!activeSection || activeSection.id === 'header') header.classList.remove('header-top');
        }
    });

    window.addEventListener('load', () => {
        select('section', true).forEach(item => item.classList.remove('section-show'));
        if (window.location.hash) {
            const initialNav = select(window.location.hash);
            if (initialNav && initialNav.tagName === 'SECTION') {
                select('#header').classList.add('header-top');
                select('#navbar .nav-link', true).forEach(item => {
                    if (item.getAttribute('href') == window.location.hash) item.classList.add('active');
                    else item.classList.remove('active');
                });
                setTimeout(() => initialNav.classList.add('section-show'), 100);
                scrollto(window.location.hash);
            }
        }
    });

    const skillsContent = select('.skills-grid');
    if (skillsContent) {
        select('.progress-bar', true).forEach(el => {
            const percent = el.getAttribute('data-percent');
            if (percent) {
                el.style.width = '0%';
                el.setAttribute('data-target', percent);
            }
        });

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bars = entry.target.querySelectorAll('.progress-bar');
                    bars.forEach(bar => {
                        const targetPercent = bar.getAttribute('data-percent');
                        if (targetPercent && bar.style.width === '0%') {
                            setTimeout(() => {
                                bar.style.width = targetPercent + '%';
                            }, 100);
                        }
                    });
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        observer.observe(skillsContent);

        new Waypoint({
            element: skillsContent,
            offset: '80%',
            handler: function(direction) {
                if (direction === 'down') {
                    select('.progress-bar', true).forEach(el => {
                        const targetPercent = el.getAttribute('data-percent');
                        if (targetPercent && el.style.width === '0%') {
                            el.style.width = targetPercent + '%';
                        }
                    });
                }
            }
        });
    }

    const portfolioContainer = select('.portfolio-container');
    if (portfolioContainer) {
        let portfolioIsotope = new Isotope(portfolioContainer, {
            itemSelector: '.portfolio-item',
            layoutMode: 'fitRows'
        });

        const filters = select('#portfolio-flters li', true);
        on('click', '#portfolio-flters li', function(e) {
            e.preventDefault();
            filters.forEach(el => el.classList.remove('filter-active'));
            this.classList.add('filter-active');
            portfolioIsotope.arrange({ filter: this.getAttribute('data-filter') });
        }, true);
    }

    GLightbox({ selector: '.portfolio-lightbox' });
    GLightbox({ selector: '.portfolio-details-lightbox', width: '90%', height: '90vh' });
})();
</script>

<style>
.spin-icon {
    animation: spin 0.8s linear infinite;
    display: inline-block;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.btn-loader {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
</style>
@endsection
