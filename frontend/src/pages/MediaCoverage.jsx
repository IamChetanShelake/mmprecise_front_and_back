import React, { useEffect, useState } from "react";
import { API, getMedia } from "../api";

function MediaCoverage() {
  const [media, setMedia] = useState([]);

  useEffect(() => {
    const fetchMedia = async () => {
      try {
        const data = await getMedia();
        setMedia(data);
      } catch (error) {
        console.error('Error fetching Media:', error);
      }
    };

    fetchMedia();
  }, []);

  const allMedia = media?.sort((a, b) => a.sort_order - b.sort_order);

  // Filter by type
  const imageMedia = allMedia?.filter((item) => item.type === "image");
  const videoMedia = allMedia?.filter((item) => item.type === "video");




  return (
    <div>
      {/* HERO SECTION */}
      <section className="container mx-auto px-6 py-12 max-w-7xl">
        <div className="flex flex-col md:flex-row items-start gap-8">
          <div className="md:w-1/3 w-full">
            <h1 className="text-3xl font-bold uppercase leading-tight">
              Media Coverage
            </h1>
            <div className="bg-orange-500 h-1 w-20 mt-2"></div>
          </div>
          <div className="md:w-2/3 w-full">
            <p className="text-gray-600 text-lg leading-8">
              Stay updated with our latest achievements, project milestones, and
              industry insights shaping the future of construction.
            </p>
          </div>
        </div>
      </section>

      {/* IMAGES SECTION */}
      <section className="container mx-auto max-w-7xl px-6 pb-12">
        <h1 className="text-3xl font-semibold text-center md:text-start">Images</h1>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 pt-8">
          {imageMedia.map((item) => (
            <div key={item.id} className="hover:-translate-y-1 transition duration-300">
              <img
                className="rounded-xl w-full h-48 object-cover"
                src={`${API}/${item.image}`}
                alt={item.title}
              />
              <h3 className="text-base text-slate-900 font-semibold mt-3">
                {item.title || "Media Image"}
              </h3>
            </div>
          ))}
        </div>
      </section>


      {/* VIDEOS SECTION */}
      <section className="container mx-auto max-w-7xl px-4 sm:px-6 pb-12">
  <h1 className="text-2xl sm:text-3xl font-semibold text-center md:text-left">
    Videos
  </h1>

  <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 pt-8">
    {videoMedia.map((item) => (
      <div
        key={item.id}
        className="group relative transition duration-300"
      >
        {/* Video Thumbnail */}
        <div className="relative overflow-hidden rounded-xl">
          <img
            className="w-full h-44 sm:h-48 md:h-56 object-cover rounded-xl group-hover:scale-105 transition duration-300"
            src={`${API}/${item.image}`}
            alt={item.title}
          />

          {/* Overlay ONLY on image hover */}
          <a
            href={item.video_url}
            target="_blank"
            rel="noopener noreferrer"
            className="absolute inset-0 bg-black/50 flex items-center justify-center rounded-xl  opacity-80 transition duration-300"
          >
            <div className="bg-white w-10 h-10 sm:w-12 sm:h-12 rounded-full flex items-center justify-center shadow-lg">
              <span className="text-black text-lg sm:text-xl font-bold">▶</span>
            </div>
          </a>
        </div>

        {/* Title (no overlay effect here) */}
        <h3 className="text-sm sm:text-base md:text-lg text-slate-900 font-semibold mt-3">
          {item.title || "Video Highlight"}
        </h3>
      </div>
    ))}
  </div>
</section>


    </div>
  );
}

export default MediaCoverage;
