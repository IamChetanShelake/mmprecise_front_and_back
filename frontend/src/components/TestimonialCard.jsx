import React from "react";
import { IoIosStar } from "react-icons/io";
import { API } from "../api";

const TestimonialCard = ({ testimonial }) => {
  return (
    <div className="border-t border-r border-t-primary border-r-primary rounded-tr-lg p-6 bg-white relative">

      {/* Dynamic Stars */}
      <div className="flex gap-1 text-orange-500">
        {[...Array(testimonial.feedback_star_rate)].map((_, i) => (
          <span key={i}><IoIosStar /></span>
        ))}
      </div>

      {/* Quote */}
      <p className="text-sm text-gray-600 mt-3">
        {testimonial.feedback_description}
      </p>

      {/* Footer */}
      <div className="flex items-center mt-5 gap-3">
        <img
          src={`${API}/${testimonial.feedback_image}`}
          alt={testimonial.feedbacker_name}
          className="w-10 h-10 rounded-full object-cover"
        />
        <div>
          <p className="font-semibold text-gray-800">{testimonial.feedbacker_name}</p>
          <p className="text-xs text-gray-500">{testimonial.feedbacker_role}</p>
        </div>
      </div>

      {/* Quote Icon (Optional - if you have the image) */}
      {/* <span className="text-orange-300 text-4xl absolute top-3 right-4">
        <img src={images.Quote} alt="Quote" className="w-10" />
      </span> */}
    </div>
  );
};

export default TestimonialCard;
