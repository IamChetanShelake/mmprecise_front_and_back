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