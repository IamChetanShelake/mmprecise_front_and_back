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

      {/* Fixed Action Button */}
      <div className="fixed bottom-6 right-6 z-50">
        <button className="bg-orange-500 text-white p-3 rounded-full shadow-lg hover:bg-orange-600 transition">
          <FaWhatsapp size={24} />
        </button>
      </div>
    </div>
  );
}

function App() {
  return <AppContent />;
}

export default App;
