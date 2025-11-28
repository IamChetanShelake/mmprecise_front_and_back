import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import { Footer, Navbar } from "./components";
import {
  About,
  Careers,
  Contact,
  CSR,
  Expertise,
  Home,
  Leadership,
  MediaCoverage,
  NewsUpdates,
  NewsUpdatesDetails,
  ProjectDetails,
  Projects,
} from "./pages";
import { FaWhatsapp } from "react-icons/fa"; 

function AppContent() {
  // Replace with your actual WhatsApp number 
  const whatsappNumber = "9096879903"; 
  
  // WhatsApp message (optional)
  const defaultMessage = "Hello! I would like to get more information.";
  
  // Create WhatsApp URL
  const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(defaultMessage)}`;

  const handleWhatsAppClick = () => {
    window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
  };

  return (
    <div className="relative min-h-screen">
      <Router>
        <Navbar />
        <Routes>
          <Route path="/" element={<Home />} />
          <Route path="/about-us" element={<About />} />
          <Route path="/leadership" element={<Leadership />} />
          <Route path="/expertise" element={<Expertise />} />
          <Route path="/projects" element={<Projects />} />
          <Route path="/project-details" element={<ProjectDetails />} />
          <Route path="/careers" element={<Careers />} />
          <Route path="/contact" element={<Contact />} />
          <Route path="/news-updates" element={<NewsUpdates />} />
          <Route path="/news-updates-details" element={<NewsUpdatesDetails />} />
          <Route path="/media-coverage" element={<MediaCoverage />} />
          <Route path="/csr" element={<CSR />} />
        </Routes>
        <Footer />
      </Router>

      {/* Fixed WhatsApp Button */}
      <div className="fixed bottom-6 right-6 z-50">
        <button 
          onClick={handleWhatsAppClick}
          className="bg-primary text-white p-4 rounded-full shadow-lg transition-all duration-300 hover:scale-110 active:scale-95"
          aria-label="Contact us on WhatsApp"
          title="Chat with us on WhatsApp"
        >
          <FaWhatsapp size={28} />
        </button>
      </div>
    </div>
  );
}

function App() {
  return <AppContent />;
}

export default App;