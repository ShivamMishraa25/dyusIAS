const translations = {
    en: {
        home: "Home",
        about: "About",
        courses: "Courses",
        faculty: "Faculty",
        announcements: "Announcements",
        contact: "Contact",
        register: "Register Now",
        explore_courses: "Explore Courses",
        hero_title: "Shape Your Future with <span>DYUS IAS</span>",
        hero_text: "Join India's premier coaching institute for Civil Services preparation with expert guidance, comprehensive study material, and proven results."
    },
    hi: {
        home: "होम",
        about: "परिचय",
        courses: "पाठ्यक्रम",
        faculty: "शिक्षक मंडल",
        announcements: "घोषणाएँ",
        contact: "संपर्क करें",
        register: "अभी पंजीकरण करें",
        explore_courses: "पाठ्यक्रम देखें",
        hero_title: "अपने भविष्य को आकार दें <span>DYUS IAS</span> के साथ",
        hero_text: "भारत के प्रमुख सिविल सेवा कोचिंग संस्थान में शामिल हों, जहाँ विशेषज्ञ मार्गदर्शन, व्यापक अध्ययन सामग्री और सिद्ध परिणाम उपलब्ध हैं।"
    }
};

// Function to change language
function setLanguage(lang) {
    localStorage.setItem("language", lang);
    document.querySelector(".language-switch").innerText = lang === "en" ? "हिन्दी" : "English";
    
    document.getElementById("nav-home").innerText = translations[lang].home;
    document.getElementById("nav-about").innerText = translations[lang].about;
    document.getElementById("nav-courses").innerText = translations[lang].courses;
    document.getElementById("nav-faculty").innerText = translations[lang].faculty;
    document.getElementById("nav-announcements").innerText = translations[lang].announcements;
    document.getElementById("nav-contact").innerText = translations[lang].contact;
    document.getElementById("register-btn").innerText = translations[lang].register;
    document.getElementById("explore-btn").innerText = translations[lang].explore_courses;
    document.getElementById("hero-title").innerHTML = translations[lang].hero_title;
    document.getElementById("hero-text").innerText = translations[lang].hero_text;
}

// Detect stored language or default to Hindi
const savedLang = localStorage.getItem("language") || "hi";
setLanguage(savedLang);

// Event Listener for language switch
document.querySelector(".language-switch").addEventListener("click", function (event) {
    event.preventDefault();
    const newLang = localStorage.getItem("language") === "en" ? "hi" : "en";
    setLanguage(newLang);
});
