import axios from "axios";

export const API = import.meta.env.VITE_BASE_URL || "http://127.0.0.1:8000"

// ================ Achievements ================
export const getAchievements = async () => {
  const response = await axios.get(`${API}/api/achievements`);
  return response.data.map((item) => ({
    id: item.id,
    title: item.title,
    description: item.description,
    img: `${API}/${item.image}`, // Full URL
  }));
};

// ================ Certifications ================
export const getCertifications = async () => {
  const response = await axios.get(`${API}/api/certifications`);
  return response.data.map((item) => ({
    id: item.id,
    title: item.title,
    location: item.location,
    img: `${API}/${item.certificate_image}`, // Full URL
  }));
};

// ================ company-overview ================
export const getCompanyOverview = async () => {
  try {
    const response = await axios.get(`${API}/api/company-overview`);
    return response.data;
  } catch (error) {
    console.error("Error fetching company-overview:", error);
    throw error;
  }
};
// ================ Our Partner ================
export const getOurPartner = async () => {
  try {
    const response = await axios.get(`${API}/api/partners`);
    return response.data;
  } catch (error) {
    console.error("Error fetching Our Partner:", error);
    throw error;
  }
};
// ================ testimonials ================
export const getTestimonials = async () => {
  try {
    const response = await axios.get(`${API}/api/testimonials`);
    return response.data;
  } catch (error) {
    console.error("Error fetching testimonials:", error);
    throw error;
  }
};

// ================ mentorships & Knowledge Sharing ================
export const getMentorship = async () => {
  try {
    const response = await axios.get(`${API}/api/mentorships`);
    return response.data;
  } catch (error) {
    console.error("Error fetching Mentorship:", error);
    throw error;
  }
};
// ================  TECHNICAL SPECIALIZATIONS ================
export const getSpecializations = async () => {
  try {
    const res = await axios.get(`${API}/api/technical-specializations`);
    const json = res.data;

    return Array.isArray(json) ? json : json.data;
  } catch (error) {
    console.error("Error fetching TECHNICAL SPECIALIZATIONS:", error);
    throw error;
  }
};

// ================  Hero Section ================
export const getHeroSection = async () => {
  try {
    const response = await axios.get(`${API}/api/hero`);
    return response.data;

  } catch (error) {
    console.error("Error fetching Hero Section:", error);
    throw error;
  }
};

// ================  About Us ================
export const getAboutUs = async () => {
  try {
    const response = await axios.get(`${API}/api/about`);
    return response.data;

  } catch (error) {
    console.error("Error fetching About Us:", error);
    throw error;
  }
};

// ================  Our Expertise ================
export const getOurExpertise = async () => {
  try {
    const response = await axios.get(`${API}/api/expertises`);
    return response.data;

  } catch (error) {
    console.error("Error fetching Our Expertise:", error);
    throw error;
  }
};

// ================  Why Choose ================
export const getWhyChoose = async () => {
  try {
    const response = await axios.get(`${API}/api/why-chooses`);
    return response.data;

  } catch (error) {
    console.error("Error fetching Why Choose:", error);
    throw error;
  }
};

// ================  GET IN TOUCH ================
export const getInTouchAPI = async () => {
  try {
    const response = await axios.get(`${API}/api/get-in-touch`);
    return response.data;

  } catch (error) {
    console.error("Error fetching GET IN TOUCH:", error);
    throw error;
  }
};

// ================  business-hours ================
export const getOfficeTime = async () => {
  try {
    const response = await axios.get(`${API}/api/business-hours`);
    return response.data;

  } catch (error) {
    console.error("Error fetching business-hours:", error);
    throw error;
  }
};

// ================  business-hours ================
export const getCareers = async () => {
  try {
    const response = await axios.get(`${API}/api/careers`);
    return response.data;

  } catch (error) {
    console.error("Error fetching Careers:", error);
    throw error;
  }
};



