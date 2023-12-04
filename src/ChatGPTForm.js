// Your React component file (e.g., ChatGPTShortcode.js)
import React, { useState, useEffect } from 'react';
import { render } from '@wordpress/element'; // Use wp.element
import ChatGPTForm from './ChatGPTForm';

// Import the CSS file using plugins_url
import 'css/chatgpt-form-styles.css'; // Check the path to your CSS file

const ChatGPTShortcode = () => {
  // State to store ChatGPT response
  const [chatGPTResponse, setChatGPTResponse] = useState('');

  useEffect(() => {
    const container = document.getElementById('chatgpt-form-container');
    if (container) {
      render(<ChatGPTShortcode />, container);
    }
  }, []); // Empty dependency array ensures the effect runs once after the initial render

  return (
    <div id="chatgpt-form-container">
      <div id="chatgpt-form">
        <h1>ChatGPT App</h1>
        <ChatGPTForm onReceiveResponse={setChatGPTResponse} />
      </div>
      <div id="chatgpt_response_container">
        <div id="chatgpt_response">
          <textarea
            id="chatgpt_textarea"
            value={chatGPTResponse}
            readOnly
          ></textarea>
        </div>
      </div>
    </div>
  );
};

export default ChatGPTShortcode;






