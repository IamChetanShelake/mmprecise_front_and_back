// import React from "react";
// import { IoIosStar } from "react-icons/io";
// import { API } from "../api";

// const TestimonialCard = ({ testimonial }) => {
//   return (
//     <div className="border-t border-r  border-primary rounded-tr-lg p-6 bg-white h-full md:w-96 flex flex-col justify-between">
//       {/* Stars */}
//       <div className="flex gap-3 text-orange-500">
//         {[...Array(testimonial.feedback_star_rate)].map((_, i) => (
//           <IoIosStar key={i} />
//         ))}
//       </div>

//       {/* Description */}
//       <p className="text-sm text-gray-600 mt-3 flex-grow">{testimonial.feedback_description}</p>

//       {/* Footer */}
//       <div className="flex items-center mt-5 gap-3">
//         <img
//           src={`${API}/${testimonial.feedback_image}`}
//           alt={testimonial.feedbacker_name}
//           className="w-10 h-10 rounded-full object-cover"
//         />
//         <div>
//           <p className="font-semibold text-gray-800">{testimonial.feedbacker_name}</p>
//           <p className="text-xs text-gray-500">{testimonial.feedbacker_role}</p>
//         </div>
//       </div>
//     </div>
//   );
// };

// export default TestimonialCard;

import React from "react";
import { IoIosStar } from "react-icons/io";
import { API } from "../api";

const TestimonialCard = ({ testimonial }) => {
  return (
    <div className="border-t border-r border-primary rounded-tr-lg p-6 bg-white h-full w-full max-w-sm mx-auto flex flex-col justify-between">
      {/* Stars */}
      <div className="flex gap-1 text-orange-500 flex-wrap">
        {[...Array(testimonial.feedback_star_rate)].map((_, i) => (
          <IoIosStar key={i} className="text-base sm:text-lg" />
        ))}
      </div>

      {/* Description */}
      <p className="text-sm sm:text-base text-gray-600 mt-3 flex-grow">
        {testimonial.feedback_description}
      </p>

      {/* Footer */}
      <div className="flex items-center mt-5 gap-3">
        <img
          src={`${API}/${testimonial.feedback_image}`}
          alt={testimonial.feedbacker_name}
          className="w-10 h-10 sm:w-12 sm:h-12 rounded-full object-cover"
        />
        <div>
          <p className="font-semibold text-gray-800 text-sm sm:text-base">
            {testimonial.feedbacker_name}
          </p>
          <p className="text-xs sm:text-sm text-gray-500">
            {testimonial.feedbacker_role}
          </p>
        </div>
      </div>
    </div>
  );
};

export default TestimonialCard;
