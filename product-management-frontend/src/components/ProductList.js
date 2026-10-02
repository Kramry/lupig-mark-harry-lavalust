import React, { useState, useEffect } from 'react';
import { productAPI } from '../api';
import ProductForm from './ProductForm';
import './ProductList.css';

const ProductList = ({ onLogout }) => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState('');
  const [showForm, setShowForm] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [username] = useState(localStorage.getItem('username'));

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    setLoading(true);
    try {
      const response = await productAPI.getAll();
      if (response.data.status === 'success') {
        setProducts(response.data.data);
      }
    } catch (err) {
      setError('Failed to fetch products');
    } finally {
      setLoading(false);
    }
  };

  const handleAdd = () => {
    setEditingProduct(null);
    setShowForm(true);
  };

  const handleEdit = (product) => {
    setEditingProduct(product);
    setShowForm(true);
  };

  const handleDelete = async (id) => {
    if (window.confirm('Are you sure you want to delete this product?')) {
      try {
        await productAPI.delete(id);
        fetchProducts();
      } catch (err) {
        setError('Failed to delete product');
      }
    }
  };

  const handleFormSubmit = () => {
    setShowForm(false);
    setEditingProduct(null);
    fetchProducts();
  };

  const handleFormCancel = () => {
    setShowForm(false);
    setEditingProduct(null);
  };

  if (loading) {
    return <div className="loading">Loading...</div>;
  }

  return (
    <div className="product-list-container">
      <header className="header">
        <h1>Product Management System</h1>
        <div className="header-actions">
          <span className="username">Welcome, {username}</span>
          <button onClick={onLogout} className="logout-btn">
            Logout
          </button>
        </div>
      </header>

      {error && <div className="error-message">{error}</div>}

      {!showForm ? (
        <>
          <div className="actions">
            <button onClick={handleAdd} className="add-btn">
              Add Product
            </button>
          </div>

          {products.length === 0 ? (
            <div className="empty-state">
              <p>No products found. Click "Add Product" to create one.</p>
            </div>
          ) : (
            <div className="products-grid">
              {products.map((product) => (
                <div key={product.id} className="product-card">
                  <h3>{product.product_name}</h3>
                  <p className="description">{product.description || 'No description'}</p>
                  <div className="product-details">
                    <span className="price">₱{parseFloat(product.price).toFixed(2)}</span>
                    <span className="quantity">Qty: {product.quantity}</span>
                  </div>
                  <div className="card-actions">
                    <button
                      onClick={() => handleEdit(product)}
                      className="edit-btn"
                    >
                      Edit
                    </button>
                    <button
                      onClick={() => handleDelete(product.id)}
                      className="delete-btn"
                    >
                      Delete
                    </button>
                  </div>
                </div>
              ))}
            </div>
          )}
        </>
      ) : (
        <ProductForm
          product={editingProduct}
          onSubmit={handleFormSubmit}
          onCancel={handleFormCancel}
        />
      )}
    </div>
  );
};

export default ProductList;
