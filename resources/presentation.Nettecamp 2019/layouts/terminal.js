import React from 'react'

export default ({ children }) => (
  <div
    className="phpstorm"
    style={{
      backgroundColor: 'rgb(2, 35, 42)',
      color: '#fafafa',
      width: '100vw',
      height: '100vw',
      padding: '1rem',
    }}>
    {children}
  </div>
)
