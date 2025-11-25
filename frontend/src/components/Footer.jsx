import { FaCertificate, FaFacebook, FaHeart, FaInstagram, FaLeaf, FaLinkedin, FaPhone, FaYoutube } from "react-icons/fa";
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
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
          {/* Company Info */}
          <div className="space-y-4">
            <div>
              <h2 className="text-2xl text-primary font-bold">MM Precise</h2>
              <p className="text-gray-300 mt-2 text-sm">
                Precision in Every Span. Excellence in Every Structure. Leading structural engineering
                company specializing in Lumley construction solutions with innovative and sustainable practices.
              </p>
            </div>
            <div className="text-gray-300">
              <p className="font-semibold text-primary">"Building Tomorrow's Infrastructure Today"</p>
            </div>
            <div className="flex space-x-3">
              <FaLinkedin className="w-6 h-6" />
              <FaYoutube className="w-6 h-6" />
              <FaInstagram className="w-6 h-6" />
              <FaFacebook className="w-6 h-6" />

            </div>
          </div>

          {/* Quick Links */}
          <div>
            <h3 className="text-lg font-semibold mb-4 text-primary">Quick Links</h3>
            <div className="grid grid-cols-2 gap-4">
              <div className="space-y-2">
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Home</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">About Us</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Leadership</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Expertise</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">News Updates</a>
              </div>
              <div className="space-y-2">
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Projects</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Media Coverage</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">Career</a>
                <a href="#" className="block text-gray-300 hover:text-white transition-colors">CER</a>
              </div>
            </div>
          </div>

          {/* Certifications & Contact */}
          <div className="space-y-6">
            {/* Certifications */}
            <div>
              <h3 className="text-lg font-semibold text-primary mb-4">Certifications</h3>
              <div className="grid grid-cols-2 gap-4">
                <div className="bg-[#2b2a2a] flex flex-col items-center gap-2 border-none p-2 rounded-lg px-6 py-4">
                  <FaCertificate className="w-10 h-10 text-primary"/>
                  <span>IEI Member</span>
                </div>
                <div className=" bg-[#2b2a2a] flex flex-col items-center gap-2 border-none p-2 rounded-lg px-6 py-4">
                  <LiaCertificateSolid className="w-10 h-10 text-primary"/>
                  <span>ACCE Certified</span>
                </div>
                <div className=" bg-[#2b2a2a] flex flex-col items-center gap-2 border-none p-2 rounded-lg px-6 py-4">
                  {/* <div className="w-4 h-4 border border-gray-400 mr-2"></div> */}
                  <MdSecurity className="w-10 h-10 text-primary" />
                  <span>ISO 9001</span>
                </div>
                <div className=" bg-[#2b2a2a] flex flex-col items-center gap-2 border-none p-2 rounded-lg px-6 py-4">
                  <FaLeaf className="w-10 h-10 text-primary"/>
                  <span>Green Certified</span>
                </div>
              </div>

            </div>

            {/* Contact Info */}
            <div className="space-y-2">
              <p className="text-gray-300 flex items-center justify-center gap-2">
                <FaLocationDot className="text-primary w-5 h-5" />
                123 Business District, Mumbai, Maharashtra 400001
              </p>

              <p className="text-gray-300 flex items-center gap-2">
                <FaPhone className="text-primary w-5 h-5" />
                +91 22 1234 5678
              </p>

              <Link
                to="mailto:info@mmprecise.com"
                className="text-gray-300 hover:text-blue-300 transition-colors flex items-center gap-2"
              >
                <IoMail className="text-primary w-5 h-5" />
                info@mmptecise.com
              </Link>
            </div>

          </div>
        </div>

        {/* Bottom Section */}
        <div className="border-t border-gray-700 mt-8 pt-8">
          <div className="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
            <div className="text-gray-300 text-sm">
              © 2024 MM Precise. All rights reserved. |
              <a href="#" className="text-primary transition-colors mx-1">Privacy Policy</a> |
              <a href="#" className="text-primary transition-colors mx-1">Terms of Service</a>
            </div>
            <div className="text-gray-400 flex items-center text-sm">
              Built with   <FaHeart className="text-primary mx-1" />   for Engineering Excellence
            </div>
          </div>
        </div>
      </div>
    </footer>
  );
};

export default Footer;