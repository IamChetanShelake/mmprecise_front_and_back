import React, { useState, useRef } from 'react';
import { Link } from 'react-router-dom';
import { images } from '../assets';
import { FiMenu, FiX, FiChevronDown, FiChevronUp } from 'react-icons/fi';
import { CgArrowTopRight } from 'react-icons/cg';
import { useEffect } from 'react';

function Navbar() {
  // 🔹 Missing States Added
  const [menuOpen, setMenuOpen] = useState(false);
  const [aboutSubmenu, setAboutSubmenu] = useState(false);
  const [newsSubmenu, setNewsSubmenu] = useState(false);

  const navRef = useRef(null);

  // 🔹 Close mobile menu when clicking a link
  const handleLinkClick = () => {
    setMenuOpen(false);
    setAboutSubmenu(false);
    setNewsSubmenu(false);
  };

  useEffect(() => {
    const handleClickOutside = (e) => {
      if (navRef.current && !navRef.current.contains(e.target)) {
        setAboutSubmenu(false);
        setNewsSubmenu(false);
      }
    };
    document.addEventListener("mousedown", handleClickOutside);
    return () => document.removeEventListener("mousedown", handleClickOutside);
  }, []);


  return (
    <div className="text-sm w-full" ref={navRef}>
      <nav className="relative h-[90px] flex items-center justify-between px-6 md:px-16 lg:px-24 xl:px-32 py-4 bg-white text-gray-900 shadow">

        {/* Logo */}
        <Link to="/" className="flex items-center">
          <img src={images.logo} alt="logo" className="w-16 h-16" />
        </Link>

        {/* Desktop Menu */}
        <div className="hidden md:flex items-center space-x-8 md:pl-28">

          <Link to="/" className="hover:text-primary transition-colors duration-200">
            Home
          </Link>

          {/* About Dropdown */}
          <div
            className="relative group"
            onClick={() => {
              setAboutSubmenu(!aboutSubmenu);
              setNewsSubmenu(false);
            }}
          >
            <div className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200">
              About 
              {aboutSubmenu ? (
              <FiChevronUp className="inline-block" />
            ) : (
              <FiChevronDown className="inline-block" />
            )}
            </div>
            {aboutSubmenu && (
              <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
                <Link onClick={() => setAboutSubmenu(false)} to="/about-us" className="block hover:text-primary">About Us</Link>
                <Link onClick={() => setAboutSubmenu(false)} to="/leadership" className="block hover:text-primary">Leadership</Link>
              </div>
            )}
          </div>

          <Link to="/expertise" className="hover:text-primary transition-colors duration-200">Expertise</Link>
          <Link to="/projects" className="hover:text-primary transition-colors duration-200">Projects</Link>
          <Link to="/careers" className="hover:text-primary transition-colors duration-200">Careers</Link>

          {/* News & Media Dropdown */}
          <div
            className="relative group"
            onClick={() => {
              setNewsSubmenu(!newsSubmenu);
              setAboutSubmenu(false);
            }}
          >
            <div className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200">
              News & Media 
              {newsSubmenu ? (
              <FiChevronUp className="inline-block" />
            ) : (
              <FiChevronDown className="inline-block" />
            )}
            </div>
            {newsSubmenu && (
              <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
                <Link to="/news-updates" className="block hover:text-primary">News Updates</Link>
                <Link to="/media-coverage" className="block hover:text-primary">Media Coverage</Link>
                <Link to="/csr" className="block hover:text-primary">CSR</Link>
              </div>
            )}
          </div>
        </div>

        {/* Contact Button */}
        <button className="hidden md:flex items-center gap-2 border border-primary ml-20 px-9 py-2 rounded-full hover:shadow-md">
          <Link to="/contact">Contact Us</Link>
          <CgArrowTopRight className="w-5 h-5" />
        </button>

        {/* Mobile Menu Button */}
        <button
          onClick={() => setMenuOpen(!menuOpen)}
          className="md:hidden active:scale-90 transition p-2 rounded-lg hover:bg-gray-100"
          aria-label="Toggle menu"
        >
          {menuOpen ? <FiX size={24} /> : <FiMenu size={24} />}
        </button>

        {/* Mobile Menu */}
        {menuOpen && (
          <div className="absolute z-30 top-full left-0 w-full bg-white shadow-lg p-6 flex flex-col space-y-4 text-lg md:hidden">
            <Link to="/" onClick={handleLinkClick} className="py-2 hover:text-primary">Home</Link>

            {/* About Mobile Dropdown */}
            <div className="relative">
              <button
                onClick={() => setAboutSubmenu(!aboutSubmenu)}
                className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200"
              >
                About <FiChevronDown className={`ml-1 transition-transform duration-200 ${aboutSubmenu ? 'rotate-180' : ''}`} />
              </button>

              {aboutSubmenu && (
                <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
                  <Link to="/about-us" className="block hover:text-primary">About Us</Link>
                  <Link to="/leadership" className="block hover:text-primary">Leadership</Link>
                </div>
              )}
            </div>

            {/* Other Mobile Links */}
            <Link to="/expertise" onClick={handleLinkClick} className="py-2">Expertise</Link>
            <Link to="/projects" onClick={handleLinkClick} className="py-2">Projects</Link>
            <Link to="/careers" onClick={handleLinkClick} className="py-2">Careers</Link>

            {/* News Dropdown */}
            <div className="border-b pb-2">
              <button
                onClick={() => setNewsSubmenu(!newsSubmenu)}
                className="flex items-center justify-between w-full py-2 hover:text-primary"
              >
                <span>News & Media</span>
                <FiChevronDown className={newsSubmenu ? 'rotate-180' : ''} />
              </button>
              {newsSubmenu && (
                <div className="ml-4 mt-2 space-y-3 text-base">
                  <Link to="/news-updates" onClick={handleLinkClick} className="block py-1">News Updates</Link>
                  <Link to="/media-coverage" onClick={handleLinkClick} className="block py-1">Media Coverage</Link>
                  <Link to="/csr" onClick={handleLinkClick} className="block py-1">CSR</Link>
                </div>
              )}
            </div>

            <button className="flex items-center gap-2 border px-8 py-3 rounded-full hover:shadow-md">
              <span>Contact Us</span>
              <CgArrowTopRight className="w-5 h-5" />
            </button>
          </div>
        )}
      </nav>
    </div>
  );
}

export default Navbar;
