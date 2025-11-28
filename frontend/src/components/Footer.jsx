import {
  FaCertificate,
  FaFacebook,
  FaHeart,
  FaInstagram,
  FaLeaf,
  FaLinkedin,
  FaPhone,
  FaYoutube,
} from "react-icons/fa";
import { FaLocationDot } from "react-icons/fa6";
import { IoMail } from "react-icons/io5";
import { LiaCertificateSolid } from "react-icons/lia";
import { MdSecurity } from "react-icons/md";
import { Link } from "react-router-dom";

const Footer = () => {
  return (
    <footer className="bg-[#1E1E1E] text-white text-sm">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {/* Main Footer Content */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-10">

          {/* Company Info */}
          <div className="space-y-4 text-center md:text-left">
            <h2 className="text-2xl text-primary font-bold">MM Precise</h2>
            <p className="text-gray-300 leading-relaxed">
              Precision in Every Span. Excellence in Every Structure. Specializing in Lumley
              construction with innovative and sustainable practices.
            </p>
            <p className="font-semibold text-primary">
              "Building Tomorrow's Infrastructure Today"
            </p>

            <div className="flex justify-center md:justify-start gap-3">
              <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer">
                <FaLinkedin className="w-6 h-6" />
              </a>
              <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer">
                <FaYoutube className="w-6 h-6" />
              </a>
              <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
                <FaInstagram className="w-6 h-6" />
              </a>
              <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">
                <FaFacebook className="w-6 h-6" />
              </a>
            </div>
          </div>

          {/* Quick Links */}
          <div className="text-center md:text-left">
            <h3 className="text-lg font-semibold text-primary mb-4">
              Quick Links
            </h3>
            <div className="grid grid-cols-2 gap-3">
              <div className="space-y-2">
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/" className="block text-gray-300 hover:text-white">Home</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/about-us" className="block text-gray-300 hover:text-white">About Us</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/leadership" className="block text-gray-300 hover:text-white">Leadership</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/expertise" className="block text-gray-300 hover:text-white">Expertise</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/news-updates" className="block text-gray-300 hover:text-white">News Updates</Link>
              </div>

              <div className="space-y-2">
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/projects" className="block text-gray-300 hover:text-white">Projects</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/media-coverage" className="block text-gray-300 hover:text-white">Media Coverage</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/careers" className="block text-gray-300 hover:text-white">Careers</Link>
                <Link onClick={() => window.scrollTo({ top: 0, left: 0, behavior: "smooth" })} to="/csr" className="block text-gray-300 hover:text-white">CSR</Link>
              </div>
            </div>
          </div>

          {/* Certifications & Contact */}
          <div className="space-y-6 text-center md:text-left">
            {/* Certifications */}
            <div>
              <h3 className="text-lg font-semibold text-primary mb-4">
                Certifications
              </h3>
              <div className="grid grid-cols-2 gap-4">
                {[
                  { icon: <FaCertificate size={35} className="text-primary" />, text: "IEI Member" },
                  { icon: <LiaCertificateSolid size={35} className="text-primary" />, text: "ACCE Certified" },
                  { icon: <MdSecurity size={35} className="text-primary" />, text: "ISO 9001" },
                  { icon: <FaLeaf size={35} className="text-primary" />, text: "Green Certified" },
                ].map((cert, idx) => (
                  <div
                    key={idx}
                    className="bg-[#2b2a2a] py-4 rounded-lg flex flex-col items-center gap-2"
                  >
                    {cert.icon}
                    <span>{cert.text}</span>
                  </div>
                ))}
              </div>
            </div>

            {/* Contact Info */}
            <div className="space-y-3">
              <p className="text-gray-300 flex items-center gap-2 justify-center md:justify-start">
                <FaLocationDot className="text-primary" />
                123 Business District, Mumbai, Maharashtra 400001
              </p>
              <p className="text-gray-300 flex items-center gap-2 justify-center md:justify-start">
                <FaPhone className="text-primary" />
                +91 22 1234 5678
              </p>
              <Link
                to="mailto:info@mmprecise.com"
                className="text-gray-300 hover:text-blue-300 flex items-center gap-2 justify-center md:justify-start"
              >
                <IoMail className="text-primary" />
                info@mmprecise.com
              </Link>
            </div>
          </div>
        </div>

        {/* Bottom Section */}
        <div className="border-t border-gray-700 mt-10 pt-6">
          <div className="flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left">
            <div className="text-gray-300 text-xs md:text-sm">
              © {new Date().getFullYear()} MM Precise. All rights reserved. |
              <Link to="#" className="text-primary mx-1">Privacy Policy</Link> |
              <Link to="#" className="text-primary mx-1">Terms of Service</Link>
            </div>
            <div className="text-gray-400 flex items-center text-xs md:text-sm">
              Built with <FaHeart className="text-primary mx-1" /> for Engineering Excellence
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
