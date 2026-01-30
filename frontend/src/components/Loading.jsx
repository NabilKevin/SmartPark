import { useEffect, useState } from "react";

const Loading = ({
  text = "SmartPark",
  speed = 80,
  pause = 500,
}) => {
  const [index, setIndex] = useState(1);
  const [forward, setForward] = useState(true);

  useEffect(() => {
    const timeout = setTimeout(() => {
      if (forward) {
        if (index < text.length) {
          setIndex(index + 1);
        } else {
          setForward(false);
        }
      } else {
        if (index > 1) {
          setIndex(index - 1);
        } else {
          setForward(true);
        }
      }
    }, index === text.length ? pause : speed);

    return () => clearTimeout(timeout);
  }, [index, forward, text, speed, pause]);

  return (
    <div className="w-screen h-screen bg-white flex items-center justify-center">
      <span className="text-slate-800 text-7xl font-bold inline-flex">
        {text.split("").map((char, i) => {
          const visible = i < index;

          return (
            <span
              key={i}
              className="transition-opacity duration-300 ease-in-out"
              style={{
                opacity: visible ? 1 : 0,
              }}
            >
              {char}
            </span>
          );
        })}
      </span>
    </div>
  )
}

export default Loading