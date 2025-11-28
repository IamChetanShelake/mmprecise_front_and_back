// import React, { useState, useRef } from 'react';
// import { Link } from 'react-router-dom';
// import { images } from '../assets';
// import { FiMenu, FiX, FiChevronDown, FiChevronUp } from 'react-icons/fi';
// import { CgArrowTopRight } from 'react-icons/cg';
// import { useEffect } from 'react';

// function Navbar() {
//   // 🔹 Missing States Added
//   const [menuOpen, setMenuOpen] = useState(false);
//   const [aboutSubmenu, setAboutSubmenu] = useState(false);
//   const [newsSubmenu, setNewsSubmenu] = useState(false);

//   const navRef = useRef(null);

//   // 🔹 Close mobile menu when clicking a link
//   const handleLinkClick = () => {
//     setMenuOpen(false);
//     setAboutSubmenu(false);
//     setNewsSubmenu(false);
//   };

//   useEffect(() => {
//     const handleClickOutside = (e) => {
//       if (navRef.current && !navRef.current.contains(e.target)) {
//         setAboutSubmenu(false);
//         setNewsSubmenu(false);
//       }
//     };
//     document.addEventListener("mousedown", handleClickOutside);
//     return () => document.removeEventListener("mousedown", handleClickOutside);
//   }, []);


//   return (
//     <div className="text-sm w-full" ref={navRef}>
//       <nav className="relative h-[90px] flex items-center justify-between px-6 md:px-16 lg:px-24 xl:px-32 py-4 bg-white text-gray-900 shadow">

//         {/* Logo */}
//         <Link to="/" className="flex items-center">
//           <img src={images.logo} alt="logo" className="w-16 h-16" />
//         </Link>

//         {/* Desktop Menu */}
//         <div className="hidden md:flex items-center space-x-8 md:pl-28">

//           <Link to="/" className="hover:text-primary transition-colors duration-200">
//             Home
//           </Link>

//           {/* About Dropdown */}
//           <div
//             className="relative group"
//             onClick={() => {
//               setAboutSubmenu(!aboutSubmenu);
//               setNewsSubmenu(false);
//             }}
//           >
//             <div className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200">
//               About 
//               {aboutSubmenu ? (
//               <FiChevronUp className="inline-block" />
//             ) : (
//               <FiChevronDown className="inline-block" />
//             )}
//             </div>
//             {aboutSubmenu && (
//               <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
//                 <Link onClick={() => setAboutSubmenu(false)} to="/about-us" className="block hover:text-primary">About Us</Link>
//                 <Link onClick={() => setAboutSubmenu(false)} to="/leadership" className="block hover:text-primary">Leadership</Link>
//               </div>
//             )}
//           </div>

//           <Link to="/expertise" className="hover:text-primary transition-colors duration-200">Expertise</Link>
//           <Link to="/projects" className="hover:text-primary transition-colors duration-200">Projects</Link>
//           <Link to="/careers" className="hover:text-primary transition-colors duration-200">Careers</Link>

//           {/* News & Media Dropdown */}
//           <div
//             className="relative group"
//             onClick={() => {
//               setNewsSubmenu(!newsSubmenu);
//               setAboutSubmenu(false);
//             }}
//           >
//             <div className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200">
//               News & Media 
//               {newsSubmenu ? (
//               <FiChevronUp className="inline-block" />
//             ) : (
//               <FiChevronDown className="inline-block" />
//             )}
//             </div>
//             {newsSubmenu && (
//               <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
//                 <Link to="/news-updates" className="block hover:text-primary">News Updates</Link>
//                 <Link to="/media-coverage" className="block hover:text-primary">Media Coverage</Link>
//                 <Link to="/csr" className="block hover:text-primary">CSR</Link>
//               </div>
//             )}
//           </div>
//         </div>

//         {/* Contact Button */}
//         <button className="hidden md:flex items-center gap-2 border border-primary ml-20 px-9 py-2 rounded-full hover:shadow-md">
//           <Link to="/contact">Contact Us</Link>
//           <CgArrowTopRight className="w-5 h-5" />
//         </button>

//         {/* Mobile Menu Button */}
//         <button
//           onClick={() => setMenuOpen(!menuOpen)}
//           className="md:hidden active:scale-90 transition p-2 rounded-lg hover:bg-gray-100"
//           aria-label="Toggle menu"
//         >
//           {menuOpen ? <FiX size={24} /> : <FiMenu size={24} />}
//         </button>

//         {/* Mobile Menu */}
//         {menuOpen && (
//           <div className="absolute z-30 top-full left-0 w-full bg-white shadow-lg p-6 flex flex-col space-y-4 text-lg md:hidden">
//             <Link to="/" onClick={handleLinkClick} className="py-2 hover:text-primary">Home</Link>

//             {/* About Mobile Dropdown */}
//             <div className="relative">
//               <button
//                 onClick={() => setAboutSubmenu(!aboutSubmenu)}
//                 className="flex items-center cursor-pointer hover:text-primary transition-colors duration-200"
//               >
//                 About <FiChevronDown className={`ml-1 transition-transform duration-200 ${aboutSubmenu ? 'rotate-180' : ''}`} />
//               </button>

//               {aboutSubmenu && (
//                 <div className="absolute top-full left-0 bg-white shadow-lg rounded-lg p-4 mt-2 space-y-3 min-w-[180px] z-50">
//                   <Link to="/about-us" className="block hover:text-primary">About Us</Link>
//                   <Link to="/leadership" className="block hover:text-primary">Leadership</Link>
//                 </div>
//               )}
//             </div>

//             {/* Other Mobile Links */}
//             <Link to="/expertise" onClick={handleLinkClick} className="py-2">Expertise</Link>
//             <Link to="/projects" onClick={handleLinkClick} className="py-2">Projects</Link>
//             <Link to="/careers" onClick={handleLinkClick} className="py-2">Careers</Link>

//             {/* News Dropdown */}
//             <div className="border-b pb-2">
//               <button
//                 onClick={() => setNewsSubmenu(!newsSubmenu)}
//                 className="flex items-center justify-between w-full py-2 hover:text-primary"
//               >
//                 <span>News & Media</span>
//                 <FiChevronDown className={newsSubmenu ? 'rotate-180' : ''} />
//               </button>
//               {newsSubmenu && (
//                 <div className="ml-4 mt-2 space-y-3 text-base">
//                   <Link to="/news-updates" onClick={handleLinkClick} className="block py-1">News Updates</Link>
//                   <Link to="/media-coverage" onClick={handleLinkClick} className="block py-1">Media Coverage</Link>
//                   <Link to="/csr" onClick={handleLinkClick} className="block py-1">CSR</Link>
//                 </div>
//               )}
//             </div>

//             <button className="flex items-center gap-2 border px-8 py-3 rounded-full hover:shadow-md">
//               <span>Contact Us</span>
//               <CgArrowTopRight className="w-5 h-5" />
//             </button>
//           </div>
//         )}
//       </nav>
//     </div>
//   );
// }

// export default Navbar;



import React, { useState, useRef, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { images } from '../assets';
import { FiMenu, FiX, FiChevronDown, FiChevronUp } from 'react-icons/fi';
import { CgArrowTopRight } from 'react-icons/cg';

function Navbar() {
  const [menuOpen, setMenuOpen] = useState(false);
  const [aboutSubmenu, setAboutSubmenu] = useState(false);
  const [newsSubmenu, setNewsSubmenu] = useState(false);
  const navRef = useRef(null);

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
    <div className="w-full" ref={navRef}>
      <nav className="relative flex items-center justify-between px-4 sm:px-8 md:px-12 lg:px-20 h-[80px] bg-white shadow text-gray-900">

        {/* Logo */}
        <Link to="/" className="flex items-center">
          <img src={images.logo} alt="logo" className="w-12 sm:w-14 h-auto" />
        </Link>

        {/* Desktop Menu */}
        <div className="hidden md:flex items-center space-x-6 lg:space-x-8">

          <Link to="/" className="hover:text-primary transition">Home</Link>

          {/* About */}
          <div className="relative">
            <button
              onClick={() => {
                setAboutSubmenu(!aboutSubmenu);
                setNewsSubmenu(false);
              }}
              className="flex items-center hover:text-primary"
            >
              About {aboutSubmenu ? <FiChevronUp /> : <FiChevronDown />}
            </button>
            {aboutSubmenu && (
              <div className="absolute left-0 mt-2 bg-white rounded-lg shadow-lg p-4 w-44 space-y-2 z-50">
                <Link to="/about-us" className="block hover:text-primary" onClick={handleLinkClick}>About Us</Link>
                <Link to="/leadership" className="block hover:text-primary" onClick={handleLinkClick}>Leadership</Link>
              </div>
            )}
          </div>

          <Link to="/expertise" className="hover:text-primary transition">Expertise</Link>
          <Link to="/projects" className="hover:text-primary transition">Projects</Link>
          <Link to="/careers" className="hover:text-primary transition">Careers</Link>

          {/* News & Media */}
          <div className="relative">
            <button
              onClick={() => {
                setNewsSubmenu(!newsSubmenu);
                setAboutSubmenu(false);
              }}
              className="flex items-center hover:text-primary"
            >
              News & Media {newsSubmenu ? <FiChevronUp /> : <FiChevronDown />}
            </button>
            {newsSubmenu && (
              <div className="absolute left-0 mt-2 bg-white rounded-lg shadow-lg p-4 w-48 space-y-2 z-50">
                <Link to="/news-updates" className="block hover:text-primary" onClick={handleLinkClick}>News Updates</Link>
                <Link to="/media-coverage" className="block hover:text-primary" onClick={handleLinkClick}>Media Coverage</Link>
                <Link to="/csr" className="block hover:text-primary" onClick={handleLinkClick}>CSR</Link>
              </div>
            )}
          </div>
        </div>

        {/* Contact Button (Desktop) */}
        <Link to="/contact" className="hidden md:flex items-center gap-2 border border-primary px-6 py-2 rounded-full hover:bg-orange-50 transition">
          Contact Us
          <CgArrowTopRight className="w-5 h-5" />
        </Link>

        {/* Mobile Menu Button */}
        <button
          onClick={() => setMenuOpen(!menuOpen)}
          className="md:hidden"
        >
          {menuOpen ? <FiX size={26} /> : <FiMenu size={26} />}
        </button>

        {/* Mobile Menu */}
        {menuOpen && (
          <div className="absolute top-full left-0 w-full bg-white shadow-lg text-base p-6 flex flex-col space-y-4 md:hidden z-50">
            <Link to="/" onClick={handleLinkClick}>Home</Link>

            {/* About Dropdown */}
            <div>
              <button
                onClick={() => setAboutSubmenu(!aboutSubmenu)}
                className="flex justify-between items-center w-full"
              >
                About {aboutSubmenu ? <FiChevronUp /> : <FiChevronDown />}
              </button>
              {aboutSubmenu && (
                <div className="mt-2 ml-4 space-y-2">
                  <Link to="/about-us" onClick={handleLinkClick}>About Us</Link>
                  <Link to="/leadership" onClick={handleLinkClick}>Leadership</Link>
                </div>
              )}
            </div>

            <Link to="/expertise" onClick={handleLinkClick}>Expertise</Link>
            <Link to="/projects" onClick={handleLinkClick}>Projects</Link>
            <Link to="/careers" onClick={handleLinkClick}>Careers</Link>

            {/* News & Media */}
            <div>
              <button
                onClick={() => setNewsSubmenu(!newsSubmenu)}
                className="flex justify-between items-center w-full"
              >
                News & Media {newsSubmenu ? <FiChevronUp /> : <FiChevronDown />}
              </button>
              {newsSubmenu && (
                <div className="mt-2 ml-4 space-y-2">
                  <Link to="/news-updates" onClick={handleLinkClick}>News Updates</Link>
                  <Link to="/media-coverage" onClick={handleLinkClick}>Media Coverage</Link>
                  <Link to="/csr" onClick={handleLinkClick}>CSR</Link>
                </div>
              )}
            </div>

            {/* Contact Button */}
            <Link
              to="/contact"
              onClick={handleLinkClick}
              className="flex items-center justify-center gap-2 border border-primary px-6 py-2 rounded-full hover:bg-orange-50 transition"
            >
              Contact Us
              <CgArrowTopRight />
            </Link>
          </div>
        )}
      </nav>
    </div>
  );
}

export default Navbar;
