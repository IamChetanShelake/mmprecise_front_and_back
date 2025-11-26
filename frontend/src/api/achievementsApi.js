import axios from 'axios';
import { API } from './api';

export const getAchievements = async () => {
  const response = await axios.get(`${API}/api/achievements`);
  return response.data.map((item) => ({
    id: item.id,
    title: item.title,
    description: item.description,
    img: `${API}/${item.image}`, // Full URL
  }));
};
