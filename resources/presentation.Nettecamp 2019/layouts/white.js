import React from 'react'

export default ({ children, yaml }) => (
  <div
    className="phpstorm"
    style={{
      backgroundColor: 'rgb(255, 255, 255)',
      width: '100vw',
      height: '100vw',
      textAlign: 'center',
      padding: '1rem',
    }}>
    {children}
  </div>
)
